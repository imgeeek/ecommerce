<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin',[AdminController::class,'index']);
Route::post('admin.auth',[AdminController::class,'auth'])->name('admin.auth');
// This is how middleware does the security
Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);
    Route::get('admin/category',[CategoryController::class,'index']);
    Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
    Route::get('admin/logout',function(){
        session()->forget('ADMIN_LOGIN');
       session()->forget('ADMIN_ID');
       session()->flash('error',"You've been logged out");
        return redirect('admin');
    });
    Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
    Route::get('admin/category/manage_category/edit/{id}',[CategoryController::class,'manage_category']);
    Route::get('admin/category/status/{type}/{id}',[CategoryController::class,'status']);
    // Coupon from here
    Route::get('admin/coupon',[CouponController::class,'index']);
    Route::get('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon']);
    Route::post('admin/coupon/manage_coupon_processs',[CouponController::class,'manage_coupon_processs']);
    Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete']);
    Route::get('admin/coupon/manage_coupon/edit/{id}',[CouponController::class,'manage_coupon']);
    
    
});