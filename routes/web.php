<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Usercontroller as Usercontrollers;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\api\Homecontroller;
use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\Productcontroller;

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
    return view('login');
});
Route::post("login", [Usercontroller::class,'login'])->name('login');
Route::get("dashboard", [Usercontroller::class,'dashboard']);

// *******************************Category Route Start*************************************
Route::get("category-list", [Categorycontroller::class,'getCategory']);
Route::get("add-new-category", [Categorycontroller::class,'addNewCategory'])->name('add-new-category');
Route::get("edit-category/{id}", [Categorycontroller::class,'addNewCategory'])->name('edit-category');
Route::get("sub-category-list", [Categorycontroller::class,'getSubategory']);
Route::get("add-new-subcategory", [Categorycontroller::class,'addNewSubategory'])->name('add-new-subcategory');
Route::get("edit-subcategory/{id}", [Categorycontroller::class,'addNewSubategory'])->name('edit-subcategory');
Route::get("sub-subcategory-list", [Categorycontroller::class,'getSubsubategory']);
Route::get("add-new-subsubcategory", [Categorycontroller::class,'addNewSubsubcategory'])->name('add-new-subsubcategory');
Route::get("edit-subsubcategory/{id}", [Categorycontroller::class,'addNewSubsubcategory'])->name('edit-subsubcategory');
Route::post("getsubcategory", [Categorycontroller::class,'getSubcategoryByAjax'])->name('getsubcategory');
Route::post("getsubsubcategory", [Categorycontroller::class,'getSubsubcategoryByAjax'])->name('getsubsubcategory');
Route::post("save-category", [Categorycontroller::class,'saveCategory']);
Route::post("update-category", [Categorycontroller::class,'updateCategory'])->name('update-category');
Route::post("save-subcategory", [Categorycontroller::class,'saveSubategory']);
Route::post("update-subcategory", [Categorycontroller::class,'updateSubategory'])->name('update-subcategory');
Route::post("save-subsubcategory", [Categorycontroller::class,'saveSubsubcategory']);
Route::post("update-subsubcategory", [Categorycontroller::class,'updateSubsubcategory'])->name('update-subsubcategory');
// *******************************Category Route End*************************************

// *******************************Vendor Route Start*************************************
Route::get("vendor-list", [Usercontroller::class,'vendorList']);
Route::get("add-new-vendor", [Usercontroller::class,'addNewVendor'])->name('add-new-vendor');
Route::post("save-vendor", [Usercontroller::class,'saveVendor']);
Route::get("edit-vendor/{id}", [Usercontroller::class,'addNewVendor'])->name('edit-vendor');
Route::post("update-vendor", [Usercontroller::class,'updateVendor'])->name('update-vendor');
// *******************************Vendor Route END*************************************

// *********************************Product Route*****************************************
Route::get("product-list", [Productcontroller::class,'productList']);
Route::get("add-new-product", [Productcontroller::class,'addNewProduct']);
Route::post("save-product", [Productcontroller::class,'saveProduct']);
Route::get("edit-product/{id}", [Productcontroller::class,'addNewProduct'])->name('edit-product');
Route::post("update-product", [Productcontroller::class,'updateProduct'])->name('update-product');
// *********************************Product Route*****************************************

// *********************************Product Route*****************************************
Route::get("user-list", [Usercontroller::class,'userList']);
Route::post("changestatus", [Usercontroller::class,'changeStatus'])->name('changestatus');





// ******************************APIS ROUTE************************************
Route::get("apis/csrf-check", [Homecontroller::class,'index']);
Route::get("apis/menu-list", [Homecontroller::class,'getMenus']);
Route::get("apis/category-list", [Homecontroller::class,'getCategory']);
Route::post("apis/register", [Usercontrollers::class,'register']);
Route::post("apis/login", [Usercontrollers::class,'login']);
Route::post("apis/get-user-profile", [Usercontrollers::class,'getUserProfile']);
Route::post("apis/add-to-cart", [Usercontrollers::class,'addToCart']);
Route::post("apis/remove-from-cart", [Usercontrollers::class,'removeFromCart']);
Route::get("apis/address-type", [Usercontrollers::class,'getAddressType']);



