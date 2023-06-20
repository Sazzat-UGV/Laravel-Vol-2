<?php

use App\Http\Controllers\backend\ModuleController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\RoleController;
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


Auth::routes();


/* Backend Routes */
Route::prefix('admin')->middleware(['auth'])->group(function(){
   //Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Resource Routes
    Route::resource('/module',ModuleController::class);
    Route::resource('/permission',PermissionController::class);
    Route::resource('/role',RoleController::class);
});
