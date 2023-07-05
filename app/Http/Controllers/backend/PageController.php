<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\page;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
}
