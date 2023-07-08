<?php

namespace App\Http\Controllers\backend;

use App\Models\page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-page'); //authorize this user to access/give assess to admin dashboard
        $pages=page::select('id','title','slug','meta_title','meta_keywords','is_active','updated_at')->get();
        return view('admin.pages.page-builder.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        Gate::authorize('create-page'); //authorize this user to access/give assess to admin dashboard
        return view('admin.pages.page-builder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {

        Gate::authorize('create-page'); //authorize this user to access/give assess to admin dashboard
        $page=page::updateOrCreate([
            'title'=>$request->title,
            'slug'=>$request->slug ?? Str::slug($request->title),
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
        ]);

        $this->image_upload($request,$page->id);
        Toastr::success('Page Created Successfully');
        return redirect()->route('page.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-page');
        $page=page::find($id);
        return view('admin.pages.page-builder.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-page');//authorize this user to access/give assess to admin dashboard
        $page=page::find($id);
        $page->update([
            'title'=>$request->title,
            'slug'=>$request->slug ?? Str::slug($request->title),
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
        ]);

        $this->image_upload($request,$page->id);
        Toastr::success('Page Updated Successfully');
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-page');//authorize this user to access/give assess to admin dashboard
        $page=page::find($id);

        if($page->page_image !=null){
            $photo_location='public/uploads/page_images/';
            $old_photo_path=$photo_location.$page->page_image;
            unlink(base_path($old_photo_path));
        }

        $page->delete();
        Toastr::success('Page Delete Successfully');
        return redirect()->route('page.index');
    }



    public function checkActive($page_id){
        Gate::authorize('edit-page');
        $page=page::find($page_id);
        if($page->is_active == 1){
            $page->is_active=0;
        }else{
            $page->is_active=1;
        }
        $page->update();
        return response()->json([
            'type' =>'success',
            'message' =>'Status Updated',
        ]);
    }



    public function image_upload($request ,$page_id){
        $page= page::find($page_id);
        if($page->page_image !=null){
            $photo_location='public/uploads/page_images/';
            $old_photo_path=$photo_location.$page->page_image;
            unlink(base_path($old_photo_path));
        }
        if($request->hasFile('page_image')){
            $photo_location='public/uploads/page_images/';
            $uploaded_photo=$request->file('page_image');
            $new_photo_name=$page_id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location=$photo_location.$new_photo_name;

            Image::make($uploaded_photo)->save(base_path($new_photo_location));
            $page->update([
                'page_image'=>$new_photo_name,
            ]);
        }
    }
}
