<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1. Create an admin role
        //2. Assign all permission on it

        $adminPermission=Permission::select('id')->get();
        Role::updateOrCreate([
            'role_name'=>'Admin',
            'role_slug'=>'admin',
            'role_note'=>'admin has all permissions',
            'is_deleteable'=>false,
        ])->permissions()->sync($adminPermission->pluck('id'));




        //Create a User role
        Role::updateOrCreate([
            'role_name'=>'User',
            'role_slug'=>'user',
            'role_note'=>'user has limited permissions',
            'is_deleteable'=>true,
        ]);
    }
}
