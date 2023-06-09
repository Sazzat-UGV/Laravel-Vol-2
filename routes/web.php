<?php

use App\Http\Controllers\backend\BackUpcontroller;
use App\Http\Controllers\backend\ModuleController;
use App\Http\Controllers\backend\PageController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('custom/{page_slug}',[FrontendController::class,'index']);


Auth::routes();


/* Backend Routes */
Route::prefix('admin')->middleware(['auth'])->group(function(){
   //Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Resource Routes
    Route::resource('/module',ModuleController::class);
    Route::resource('/permission',PermissionController::class);
    Route::resource('/role',RoleController::class);
    Route::resource('/user',UserController::class);
    Route::resource('/page',PageController::class);
    Route::resource('/backup',BackUpcontroller::class)->only(['index','store','destroy']);

    Route::get('/backup/download/{file_name}',[BackUpcontroller::class,'download'])->name('backupDownload');

    //Active or Inactive Routes
    Route::get('check/user/is_active/{user_id}',[UserController::class,'checkActive'])->name('user.is_active.ajax');
    Route::get('check/page/is_active/{page_id}',[PageController::class,'checkActive'])->name('page.is_active.ajax');

    //Profile Management Route
    Route::get('update-profile',[ProfileController::class,'getUpdateProfile'])->name('getupdate.profile');
    Route::post('update-profile',[ProfileController::class,'UpdateProfile'])->name('postupdate.profile');

    Route::get('update-password',[ProfileController::class,'getUpdatePassword'])->name('getupdate.Password');
    Route::post('update-password',[ProfileController::class,'UpdatePassword'])->name('postupdate.Password');
});
