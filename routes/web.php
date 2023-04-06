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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatisticalController;

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
Route::post('/product-tabs', [HomeController::class, 'product_tabs']);

Route::get('/lien-he', [ContactController::class, 'contact']);

//product_search
Route::post('/tim-kiem', [ProductController::class, 'search']);
Route::post('/autocomplete-search', [ProductController::class, 'autocomplete_search']);
//product_tag
Route::get('/tag/{product_tag}', [ProductController::class, 'tag']);
//product_category_index
Route::get('/danh-muc-san-pham/{category_slug}', [CategoryController::class, 'show_category_home']);
//product_brand_index
Route::get('/thuong-hieu-san-pham/{brand_slug}', [BrandController::class, 'show_brand_home']);
//product_detail
Route::get('/chi-tiet-san-pham/{product_slug}', [ProductController::class, 'product_detail']);
Route::post('/quickview', [ProductController::class, 'quickview']);


//cart
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax']);
Route::post('/update-cart-ajax', [CartController::class, 'update_cart_ajax']);
Route::get('/delete-cart-ajax/{session_id}', [CartController::class, 'delete_cart_ajax']);
Route::get('/delete-all-cart-ajax', [CartController::class, 'delete_all_cart_ajax']);
Route::get('/counter-cart', [CartController::class, 'counter_cart']);
Route::get('/preview-cart', [CartController::class, 'preview_cart']);
// Route::post('/add-cart', [CartController::class, 'add_cart']);
// Route::get('/show-cart', [CartController::class, 'show_cart']);
// Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
// Route::get('/delete-cart/{rowID}', [CartController::class, 'delete_cart']);


//login customer
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);

Route::get('/customer-login-google', [CheckoutController::class, 'customer_login_google']);
Route::get('/customer/google/callback', [CheckoutController::class, 'callback_customer_google']);

Route::get('/customer-login-facebook', [CheckoutController::class, 'customer_login_facebook']);
Route::get('/customer/facebook/callback', [CheckoutController::class, 'callback_customer_facebook']);

//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);
// Route::get('/payment', [CheckoutController::class, 'payment']);
// Route::post('/restore-checkout', [CheckoutController::class, 'restore_checkout']);
// Route::post('/order-place', [CheckoutController::class, 'order_place']);


//check_coupon
Route::post('/check-coupon', [CartController::class, 'check_coupon']);
Route::get('/unset-coupon', [CartController::class, 'unset_coupon']);

//customer forget pw
Route::get('/customer-forget-password', [HomeController::class, 'customer_forget_password']);
Route::get('/update-new-pass', [HomeController::class, 'update_new_pass']);
Route::post('/confirm-password', [HomeController::class, 'confirm_password']);

//send mail
Route::get('/send-mail', [HomeController::class, 'send_mail']);//send mail from customer
Route::post('/send-mail-recover-password', [HomeController::class, 'send_mail_recover_password']);


//post
Route::get('/danh-muc-tin-tuc/{cate_post_slug}', [CategoryPostController::class, 'show_cate_post']);
Route::get('/tin-tuc/{post_slug}', [PostController::class, 'post_detail']);
Route::get('/tin-tuc', [PostController::class, 'show_post_home']);

//comment product
Route::post('/load-comment', [CommentController::class, 'load_comment']);
Route::post('/send-comment', [CommentController::class, 'send_comment']);
Route::post('/add-rating', [CommentController::class, 'add_rating']);

//history order 
Route::get('/history-order', [OrderController::class, 'history_order']);
Route::get('/view-history-order/{order_code}', [OrderController::class, 'view_history_order']);
Route::get('/cancel-order/{order_code}', [OrderController::class, 'cancel_order']);

//payment online
Route::post('/vnpay-payment', [CheckoutController::class, 'vnpay_payment']);






















//------------gate_name in app/provider/AuthServiceProvider--------------


//admin
Route::get('/login', [AdminController::class, 'index']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);



//dashboard
Route::get('/dashboard', [StatisticalController::class, 'show_dashboard']);

Route::get('/order-date', [StatisticalController::class, 'order_date']);

Route::post('/filter-by-date', [StatisticalController::class, 'filter_by_date']);
Route::post('/days-order', [StatisticalController::class, 'days_order']);
Route::post('/dashboard-filter', [StatisticalController::class, 'dashboard_filter']);



//category
Route::get('/list-category', [CategoryController::class, 'list_category'])->middleware('can:list-category');
Route::get('/add-category', [CategoryController::class, 'add_category'])->middleware('can:add-category');
Route::post('/store-category', [CategoryController::class, 'store_category']);
Route::get('/active-category/{category_id}', [CategoryController::class, 'active_category']);
Route::get('/unactive-category/{category_id}', [CategoryController::class, 'unactive_category']);
Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit_category'])->middleware('can:edit-category');
Route::post('/update-category/{category_id}', [CategoryController::class, 'update_category']);
Route::post('/arrange-category', [CategoryController::class, 'arrange_category']);
Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete_category'])->middleware('can:delete-category');


//brand
Route::get('/list-brand', [BrandController::class, 'list_brand'])->middleware('can:list-brand');
Route::get('/add-brand', [BrandController::class, 'add_brand'])->middleware('can:add-brand');
Route::post('/store-brand', [BrandController::class, 'store_brand']);
Route::get('/active-brand/{brand_id}', [BrandController::class, 'active_brand']);
Route::get('/unactive-brand/{brand_id}', [BrandController::class, 'unactive_brand']);
Route::get('/edit-brand/{brand_id}', [BrandController::class, 'edit_brand'])->middleware('can:edit-brand');
Route::post('/update-brand/{brand_id}', [BrandController::class, 'update_brand']);
Route::post('/arrange-brand', [BrandController::class, 'arrange_brand']);
Route::get('/delete-brand/{brand_id}', [BrandController::class, 'delete_brand'])->middleware('can:delete-brand');

//coupon
Route::get('/list-coupon', [CouponController::class, 'list_coupon'])->middleware('can:list-coupon');
Route::get('/active-coupon/{coupon_id}', [CouponController::class, 'active_coupon']);
Route::get('/unactive-coupon/{coupon_id}', [CouponController::class, 'unactive_coupon']);
Route::get('/add-coupon', [CouponController::class, 'add_coupon'])->middleware('can:add-coupon');
Route::post('/store-coupon', [CouponController::class, 'store_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon'])->middleware('can:delete-coupon');

//product
Route::get('/list-product', [ProductController::class, 'list_product'])->middleware('can:list-product');
Route::get('/list-product-discount', [ProductController::class, 'list_product_discount']);
Route::get('/add-product', [ProductController::class, 'add_product'])->middleware('can:add-product');
Route::post('/store-product', [ProductController::class, 'store_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product'])->middleware('can:edit-product');
Route::get('/edit-product-discount/{product_id}', [ProductController::class, 'edit_product_discount']);
Route::get('/edit-discount-all', [ProductController::class, 'edit_discount_all']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::post('/update-product-discount/{product_id}', [ProductController::class, 'update_product_discount']);
Route::post('/update-discount-all', [ProductController::class, 'update_discount_all']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product'])->middleware('can:delete-product');

//ckeditor

Route::post('/uploads-ckeditor', [AdminController::class, 'ckeditor_image']);
Route::get('/file-browser', [AdminController::class, 'file_browser']);


//order 
Route::get('/list-order', [OrderController::class, 'list_order'])->middleware('can:list-order');
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order'])->middleware('can:edit-order');
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
Route::post('/update-qty', [OrderController::class, 'update_qty']);
Route::get('/delete-order/{order_code}', [OrderController::class, 'delete_order'])->middleware('can:delete-order');

//delivery
Route::get('/delivery', [DeliveryController::class, 'delivery'])->middleware('can:list-feeship');
Route::get('/unset-feeship', [DeliveryController::class, 'unset_feeship']);
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/add-delivery', [DeliveryController::class, 'add_delivery'])->middleware('can:add-feeship');
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship']);
Route::post('/update-delivery', [DeliveryController::class, 'update_delivery']);
Route::post('/caculate-fee', [DeliveryController::class, 'caculate_fee']);


//slider
Route::get('/list-slider', [SliderController::class, 'list_slider'])->middleware('can:list-slider');
Route::get('/add-slider', [SliderController::class, 'add_slider'])->middleware('can:add-slider');
Route::post('/store-slider', [SliderController::class, 'store_slider']);
Route::get('/active-slider/{slider_id}', [SliderController::class, 'active_slider']);
Route::get('/unactive-slider/{slider_id}', [SliderController::class, 'unactive_slider']);
Route::get('/edit-slider/{slider_id}', [SliderController::class, 'edit_slider'])->middleware('can:edit-slider');
Route::post('/update-slider/{slider_id}', [SliderController::class, 'update_slider']);
Route::get('/delete-slider/{slider_id}', [SliderController::class, 'delete_slider'])->middleware('can:delete-slider');


//user
Route::get('/list-user', [AdminController::class, 'list_user'])->middleware('can:list-user');
Route::get('/add-user', [AdminController::class, 'add_user'])->middleware('can:add-user');
Route::post('/store-user', [AdminController::class, 'store_user']);
Route::get('/edit-user/{id}', [AdminController::class, 'edit_user'])->middleware('can:edit-user');
Route::post('/update-user/{id}', [AdminController::class, 'update_user']);
Route::get('/delete-user/{id}', [AdminController::class, 'delete_user'])->middleware('can:delete-user');


//role
Route::get('/list-roles', [AdminRoleController::class, 'list_roles'])->middleware('can:list-role');
Route::get('/add-roles', [AdminRoleController::class, 'add_roles'])->middleware('can:add-role');
Route::post('/store-roles', [AdminRoleController::class, 'store_roles']);
Route::get('/edit-roles/{role_id}', [AdminRoleController::class, 'edit_roles'])->middleware('can:edit-role');
Route::post('/update-roles/{role_id}', [AdminRoleController::class, 'update_roles']);
Route::get('/delete-roles/{role_id}', [AdminRoleController::class, 'delete_roles'])->middleware('can:delete-role');


//post-category
Route::get('/list-cate-post', [CategoryPostController::class, 'list_cate_post']);
Route::get('/add-cate-post', [CategoryPostController::class, 'add_cate_post']);
Route::post('/store-cate-post', [CategoryPostController::class, 'store_cate_post']);
Route::get('/active-cate-post/{cate_post_id}', [CategoryPostController::class, 'active_cate_post']);
Route::get('/unactive-cate-post/{cate_post_id}', [CategoryPostController::class, 'unactive_cate_post']);
Route::get('/edit-cate-post/{cate_post_id}', [CategoryPostController::class, 'edit_cate_post']);
Route::post('/update-cate-post/{cate_post_id}', [CategoryPostController::class, 'update_cate_post']);
Route::get('/delete-cate-post/{cate_post_id}', [CategoryPostController::class, 'delete_cate_post']);

//post
Route::get('/list-post', [PostController::class, 'list_post']);
Route::get('/add-post', [PostController::class, 'add_post']);
Route::post('/store-post', [PostController::class, 'store_post']);
Route::get('/active-post/{post_id}', [PostController::class, 'active_post']);
Route::get('/unactive-post/{post_id}', [PostController::class, 'unactive_post']);
Route::get('/edit-post/{post_id}', [PostController::class, 'edit_post']);
Route::post('/update-post/{post_id}', [PostController::class, 'update_post']);
Route::get('/delete-post/{post_id}', [PostController::class, 'delete_post']);

//gallery
Route::get('/add-gallery/{product_id}', [GalleryController::class, 'add_gallery']);
Route::post('/select-gallery', [GalleryController::class, 'select_gallery']);
Route::post('/store-gallery/{product_id}', [GalleryController::class, 'store_gallery']);
Route::post('/update-gallery-name', [GalleryController::class, 'update_gallery_name']);
Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery']);

//comment product
Route::get('/list-comment', [CommentController::class, 'list_comment']);
Route::get('/active-comment/{comment_id}', [CommentController::class, 'active_comment']);
Route::get('/unactive-comment/{comment_id}', [CommentController::class, 'unactive_comment']);
Route::post('/reply-comment', [CommentController::class, 'reply_comment']);
Route::get('/delete-comment/{comment_id}', [CommentController::class, 'delete_comment']);

//info
Route::get('/add-info', [ContactController::class, 'add_info']);
Route::post('/store-info', [ContactController::class, 'store_info']);
Route::post('/update-info/{info_id}', [ContactController::class, 'update_info']);
Route::post('/update-icon/{id_icon}', [ContactController::class, 'update_icon']);

Route::post('/add-partner', [ContactController::class, 'add_partner']);
Route::get('/list-partner', [ContactController::class, 'list_partner']);
Route::get('/delete-partner', [ContactController::class, 'delete_partner']);


//send email coupon to customer
Route::get('/send-coupon/{coupon_quantity}/{coupon_code}/{coupon_number}/{coupon_function}', [AdminController::class, 'send_coupon']);