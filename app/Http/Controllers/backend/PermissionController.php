<?php

namespace App\Http\Controllers\backend;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\PermissionStoreRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions= Permission::with(['module:id,module_name,module_slug'])->select('id','module_id','permission_name','permission_slug','updated_at')->latest('id')->paginate();
        return view('admin.pages.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules=Module::select('id','module_name')->get();
        return view('admin.pages.permission.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionStoreRequest $request)
    {
        Permission::updateOrCreate([
            'module_id'=>$request->module_id,
            'permission_name'=>$request->permission_name,
            'permission_slug'=>Str::slug($request->permission_name)
        ]);
        Toastr::success('Permission Created Successfully');
        return redirect()->route('permission.index');
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
        $modules=Module::select('id','module_name')->get();
        $permission=Permission::find($id);

        return view('admin.pages.permission.edit',compact('modules','permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionStoreRequest $request, string $id)
    {
        $permission=Permission::find($id);
        $permission->update([
            'module_id'=>$request->module_id,
            'permission_name'=>$request->permission_name,
            'permission_slug'=>Str::slug($request->permission_name)
        ]);
        Toastr::success('Permission Updated Successfully');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission=Permission::find($id);
        $permission->delete();
        Toastr::success('Permission Delete Successfully');
        return redirect()->route('permission.index');
    }
}
