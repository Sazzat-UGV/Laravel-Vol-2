<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //create Admin
        $adminRoleId=Role::where('role_slug','admin')->first()->id;
        User::updateOrCreate([
            'role_id'=>$adminRoleId,
            'name'=>'Asikul Islam Sazzat',
            'email'=>'asikulislamsazzat@gmail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('12011016'),
            'remember_token'=>Str::random(10),
        ]);

        //create user
        $userRoleId=Role::where('role_slug','user')->first()->id;
        User::updateOrCreate([
            'role_id'=>$userRoleId,
            'name'=>'User',
            'email'=>'user@gmail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('12011029'),
            'remember_token'=>Str::random(10),
        ]);

    }
}
