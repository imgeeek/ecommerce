<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontController;
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

// Route::get('/', function () {
//     return view('front.welcome');
// });
Route::get('/',[FrontController::class,'index']);

















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
    
    //Size from here
    Route::get('admin/size',[SizeController::class,'index']);
    Route::get('admin/size/manage_size',[SizeController::class,'manage_size']);
    Route::post('admin/size/manage_size_processs',[SizeController::class,'manage_size_processs'])->name('size.manage_size_process');
    Route::get('admin/size/delete/{id}',[SizeController::class,'delete']);
    Route::get('admin/size/manage_size/edit/{id}',[SizeController::class,'manage_size']);
    Route::get('admin/size/status/{type}/{id}',[SizeController::class,'status']);
    //color from here
    Route::get('admin/color',[ColorController::class,'index']);
    Route::get('admin/color/manage_color',[ColorController::class,'manage_color']);
    Route::post('admin/color/manage_color_process',[ColorController::class,'manage_color_process'])->name('color.manage_color_process');
    Route::get('admin/color/delete/{id}',[ColorController::class,'delete']);
    Route::get('admin/color/manage_size/edit/{id}',[ColorController::class,'manage_color']);
    Route::get('admin/color/status/{type}/{id}',[ColorController::class,'status']);

    // Product controller routing from here
    Route::get('admin/product',[ProductController::class,'index']);
    Route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
    Route::post('admin/product/manage_product_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
    Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
    Route::get('admin/product/manage_product/edit/{id}',[ProductController::class,'manage_product']);
    Route::get('admin/product/status/{type}/{id}',[ProductController::class,'status']);
    // deleting the product attribute
    Route::get('admin/product/products_attr/delete/{id}/{cid}',[ProductController::class,'deleting']);
    Route::get('admin/product/products_images/delete/{id}/{cid}',[ProductController::class,'deleting_images']);

    //Branding starts from here
    Route::get('admin/brand',[BrandController::class,'index']);
    Route::get('admin/brand/manage_brand',[BrandController::class,'manage_brand']);
    Route::post('admin/brand/manage_brand_processs',[BrandController::class,'manage_brand_processs'])->name('brand.manage_brand_process');
    Route::get('admin/brand/delete/{id}',[BrandController::class,'delete']);
    Route::get('admin/brand/manage_brand/edit/{id}',[BrandController::class,'manage_brand']);

    //Tax routing starts from here
    Route::get('admin/tax',[TaxController::class,'index']);
    Route::get('admin/tax/manage_tax',[TaxController::class,'manage_tax']);
    Route::post('admin/tax/manage_tax_processs',[TaxController::class,'manage_tax_processs'])->name('tax.manage_tax_process');
    Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']);
    Route::get('admin/tax/manage_tax/edit/{id}',[TaxController::class,'manage_tax']);
    Route::get('admin/tax/status/{type}/{id}',[TaxController::class,'status']);

    //customering
    Route::get('admin/customer',[CustomerController::class,'index']);
    Route::get('admin/customer/status/{type}/{id}',[CustomerController::class,'status']);


    //FrontController
});