<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\BrandController; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\CartController; 
use App\Http\Controllers\CheckoutController; 
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
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

//index
Route::get('/' , [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);

//product_search
Route::post('/tim-kiem', [ProductController::class, 'search']);
//product_category_index
Route::get('/danh-muc-san-pham/{category_id}', [CategoryController::class, 'show_category_home']);
//product_brand_index
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandController::class, 'show_brand_home']);
//product_detail
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'product_detail']);

//cart
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax']);
Route::post('/update-cart-ajax', [CartController::class, 'update_cart_ajax']);
Route::get('/delete-cart-ajax/{session_id}', [CartController::class, 'delete_cart_ajax']);
Route::get('/delete-all-cart-ajax', [CartController::class, 'delete_all_cart_ajax']);
// Route::post('/add-cart', [CartController::class, 'add_cart']);
// Route::get('/show-cart', [CartController::class, 'show_cart']);
// Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
// Route::get('/delete-cart/{rowID}', [CartController::class, 'delete_cart']);


//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/restore-checkout', [CheckoutController::class, 'restore_checkout']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);

//check_coupon
Route::post('/check-coupon', [CartController::class, 'check_coupon']);
Route::get('/unset-coupon', [CartController::class, 'unset_coupon']);

//send mail
Route::get('/send-mail', [HomeController::class, 'send_mail']);









//admin
Route::get('/login', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);


//category
Route::get('/list-category', [CategoryController::class, 'list_category']);
Route::get('/add-category', [CategoryController::class, 'add_category']);
Route::post('/store-category', [CategoryController::class, 'store_category']);
Route::get('/active-category/{category_id}', [CategoryController::class, 'active_category']);
Route::get('/unactive-category/{category_id}', [CategoryController::class, 'unactive_category']);
Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit_category']);
Route::post('/update-category/{category_id}', [CategoryController::class, 'update_category']);
Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete_category']);


//brand
Route::get('/list-brand', [BrandController::class, 'list_brand']);
Route::get('/add-brand', [BrandController::class, 'add_brand']);
Route::post('/store-brand', [BrandController::class, 'store_brand']);
Route::get('/active-brand/{brand_id}', [BrandController::class, 'active_brand']);
Route::get('/unactive-brand/{brand_id}', [BrandController::class, 'unactive_brand']);
Route::get('/edit-brand/{brand_id}', [BrandController::class, 'edit_brand']);
Route::post('/update-brand/{brand_id}', [BrandController::class, 'update_brand']);
Route::get('/delete-brand/{brand_id}', [BrandController::class, 'delete_brand']);

//coupon
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);
Route::get('/add-coupon', [CouponController::class, 'add_coupon']);
Route::post('/store-coupon', [CouponController::class, 'store_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);

//product
Route::get('/list-product', [ProductController::class, 'list_product']);
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::post('/store-product', [ProductController::class, 'store_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);

//order 
Route::get('/manage-order', [CheckoutController::class, 'manage_order']);
Route::get('/view-order/{order_id}', [CheckoutController::class, 'view_order']);

//delivery
Route::get('/delivery', [DeliveryController::class, 'delivery']);
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/add-delivery', [DeliveryController::class, 'add_delivery']);
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship']);
Route::post('/update-delivery', [DeliveryController::class, 'update_delivery']);