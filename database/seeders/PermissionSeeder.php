<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $adminPermissionArray=[
        'Access Dashboard',
       ];

       $adminRolePermissionArray=[
        'Index Role',
        'Create Role',
        'Edit Role',
        'Delete Role',
       ];

       $adminUserPermissionArray=[
        'Index User',
        'Create User',
        'Edit User',
        'Delete User',
       ];

       $adminPermissionPermissionArray=[
        'Index Permission',
        'Create Permission',
        'Edit Permission',
        'Delete Permission',
       ];

       $adminPageBuilderPermissionArray=[
        'Index Page',
        'Create Page',
        'Edit Page',
        'Delete Page',
       ];
       //Access Dashboard
       $adminDashboardModule=Module::where('module_name','Admin Dashboard')->select('id')->first();
       Permission::updateOrCreate([
        'module_id'=>$adminDashboardModule->id,
        'permission_name'=>$adminPermissionArray[0],
        'permission_slug'=>Str::slug($adminPermissionArray[0]),
       ]);

       //Role Management
       $roleManagementModule=Module::where('module_name','Role Management')->select('id')->first();
       for($i=0;$i<count($adminRolePermissionArray);$i++){
           Permission::updateOrCreate([
            'module_id'=>$roleManagementModule->id,
            'permission_name'=>$adminRolePermissionArray[$i],
            'permission_slug'=>Str::slug($adminRolePermissionArray[$i]),
           ]);
       }
       //user Management
       $userManagementModule=Module::where('module_name','User Management')->select('id')->first();
       for($i=0;$i<count($adminUserPermissionArray);$i++){
           Permission::updateOrCreate([
            'module_id'=>$userManagementModule->id,
            'permission_name'=>$adminUserPermissionArray[$i],
            'permission_slug'=>Str::slug($adminUserPermissionArray[$i]),
           ]);
       }
       //Permission Management
       $PermissionManagementModule=Module::where('module_name','Permission Management')->select('id')->first();
       for($i=0;$i<count($adminPermissionPermissionArray);$i++){
           Permission::updateOrCreate([
            'module_id'=>$PermissionManagementModule->id,
            'permission_name'=>$adminPermissionPermissionArray[$i],
            'permission_slug'=>Str::slug($adminPermissionPermissionArray[$i]),
           ]);
       }
       //Page Builder
       $PageBuilderModule=Module::where('module_name','Page Builder')->select('id')->first();
       for($i=0;$i<count($adminPageBuilderPermissionArray);$i++){
           Permission::updateOrCreate([
            'module_id'=>$PageBuilderModule->id,
            'permission_name'=>$adminPageBuilderPermissionArray[$i],
            'permission_slug'=>Str::slug($adminPageBuilderPermissionArray[$i]),
           ]);
       }

    }
}
