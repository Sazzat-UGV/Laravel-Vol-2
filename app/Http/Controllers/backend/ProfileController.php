<?php

namespace App\Http\Controllers\backend;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordChangeRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileStoreRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getUpdateProfile(){
        $auth_user=Auth::user();
        return view('admin.pages.profile.update_profile',compact('auth_user'));
    }

    public function UpdateProfile(ProfileStoreRequest $request){
        $auth_user=Auth::user();
        $user=User::whereEmail($auth_user->email)->first();
        $this->image_upload($request, $user->id);

        Toastr::success('Profile Updated Successfully');
        return back();
    }


    public function getUpdatePassword(){
        return view('admin.pages.profile.update_password');
    }


    public function UpdatePassword(ProfilePasswordChangeRequest $request){

        $user=Auth::user();
        $hashedPassword=$user->password;

        if(Hash::check($request->old_password, $hashedPassword)){
            if(!Hash::check($request->new_password, $hashedPassword)){
                $user->update([
                    'password'=>Hash::make($request->password),
                ]);
                Auth::logout();
                Toastr::success('Password Updated Successfully!');
                return redirect()->route('login');

            }else{
                Toastr::error('New Password Cannot be the same as old Password');
                return back();
            }
        }else{
            Toastr::error("Current Password doesn't match");
            return back();
        }

    }


    public function image_upload($request ,$user_id){
        $user= User::find($user_id);
        if($user->user_image !=null){
            $photo_location='public/uploads/profile_images/';
            $old_photo_path=$photo_location.$user->user_image;
            unlink(base_path($old_photo_path));
        }
        if($request->hasFile('user_image')){
            $photo_location='public/uploads/profile_images/';
            $uploaded_photo=$request->file('user_image');
            $new_photo_name=$user_id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location=$photo_location.$new_photo_name;

            Image::make($uploaded_photo)->resize(600,600)->save(base_path($new_photo_location));
            $user->update([
                'user_image'=>$new_photo_name,
            ]);
        }
    }
}
