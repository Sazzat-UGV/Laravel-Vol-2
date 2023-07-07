<?php

namespace App\Http\Controllers\backend;

use App\Models\page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PageStoreRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages=page::select('id','title','slug','meta_title','meta_keywords','is_active','updated_at')->get();
        return view('admin.pages.page-builder.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.page-builder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkActive($page_id){
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

            Image::make($uploaded_photo)->resize(600,600)->save(base_path($new_photo_location));
            $page->update([
                'page_image'=>$new_photo_name,
            ]);
        }
    }
}
