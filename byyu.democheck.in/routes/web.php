<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;    
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;     
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

Route::get('/clear-all', function () {
Artisan::call('config:cache');
Artisan::call('config:clear');
Artisan::call('route:clear');
Artisan::call('view:clear');
return "Cache, route, view, config is cleared";
});


//Home Controller Routes        
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/new-index', [HomeController::class, 'newindex'])->name('new-index');

Route::get('category-listing', [ProductController::class, 'getCategories']);
Route::get('product-details/{product_id}', [ProductController::class, 'getProductDetail']);

Route::get('product-list/{category_id}', [ProductController::class, 'index']);
Route::get('event-product-list/{event_id}', [ProductController::class, 'eventProductListing']);
Route::post('product-filter', [ProductController::class, 'productFilters']);
Route::get('product-filter', [ProductController::class, 'getproductFilters']);
Route::get('search', [ProductController::class, 'search']);
Route::get('product-gift-now', [ProductController::class, 'productGiftNow']);


//addToWishlist
Route::post('add-to-wishlist', [ProfileController::class, 'addToWishlist']);

//login routes
Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('loginotp/{id?}', [UserController::class, 'loginotp'])->name('loginotp');
Route::get('register/{id?}', [UserController::class, 'register'])->name('register');
Route::get('logingoogle', [UserController::class, 'logingoogle'])->name('login.google');
Route::get('callback', [UserController::class, 'callback']);
Route::get('loginuser/{id}', [UserController::class, 'loginuser'])->name('loginuser');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('userprofile', [UserController::class, 'userprofile'])->name('userprofile');
Route::post('delete-account', [UserController::class, 'deleteaccount'])->name('deleteaccount');
Route::get('special-day', [UserController::class, 'specialday'])->name('specialday');
Route::get('referralearn', [UserController::class, 'referralearn'])->name('referralearn');
Route::get('wallet', [UserController::class, 'wallet'])->name('wallet');
Route::get('contact-us', [UserController::class, 'contactus'])->name('contactus');
Route::post('contact-us-submit', [UserController::class, 'contactus_submit'])->name('contactussubmit');
Route::get('corporategifts', [UserController::class, 'corporategifts'])->name('corporategifts');
Route::get('offers', [UserController::class, 'offers'])->name('offers');
Route::get('coupons-list', [UserController::class, 'couponslist'])->name('couponslist');
Route::get('updatemobilenumber/{updateField}', [UserController::class, 'updatemobilenumber'])->name('updatemobilenumber');

Route::get('privacypolicy', [UserController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('termsconditions', [UserController::class, 'termsconditions'])->name('termsconditions');
Route::get('comingsoon', [UserController::class, 'comingsoon'])->name('comingsoon');
Route::get('privacypolicy.html', [UserController::class, 'privacypolicy'])->name('privacypolicy');

Route::get('user-contact-us', [UserController::class, 'usercontactus'])->name('usercontactus');
Route::get('myorders', [UserController::class, 'myorders'])->name('myorders');
Route::get('orderd_deatils/{id}', [UserController::class, 'orderd_deatils'])->name('orderd_deatils');
Route::post('loginsubmit', [UserController::class, 'loginsubmit'])->name('loginsubmit');
Route::post('registeruser', [UserController::class, 'registeruser'])->name('registeruser');
Route::post('loginotpsubmit', [UserController::class, 'loginotpsubmit'])->name('loginotpsubmit');
Route::post('userprofilesubmit', [UserController::class, 'userprofilesubmit'])->name('userprofilesubmit');
Route::get('specialdayadd/{id}', [UserController::class, 'specialdayadd'])->name('specialdayadd');
Route::post('specialdaysubmit', [UserController::class, 'specialdaysubmit'])->name('specialdaysubmit');
Route::get('useraddress', [UserController::class, 'address'])->name('address');
Route::get('giftvoucher', [UserController::class, 'giftvoucher'])->name('giftvoucher');
Route::post('redeemgiftvoucher', [UserController::class, 'redeemgiftvoucher'])->name('redeemgiftvoucher');
Route::get('getmap/{addresstype}/{id}', [UserController::class, 'getmap'])->name('getmap');
Route::get('address-new/{addresstype}/{id}', [UserController::class, 'addressnew'])->name('addressnew');
Route::post('addaddress', [UserController::class, 'addaddress'])->name('addaddress');
Route::get('deleteaddress/{id}', [UserController::class, 'deleteaddress'])->name('deleteaddress');
Route::get('deletemember/{id}', [UserController::class, 'deletemember'])->name('deletemember');
Route::get('updatemember', [UserController::class, 'updatemember'])->name('updatemember');

//addToWishlist
Route::post('add-to-wishlist', [ProfileController::class, 'addToWishlist']);
Route::get('wishlist', [ProfileController::class, 'getWishlist']);

Route::post('add-to-cart', [CartController::class, 'addToCart']);
Route::get('cart-summary', [CartController::class, 'getCartSummary'])->name('cart');
Route::get('address', [CartController::class, 'getAddress'])->name('cartaddress');
Route::get('checkout', [CartController::class, 'getCheckoutDetails']);

Route::post('load-payment', [CartController::class, 'loadPayment']);
Route::post('payment-process', [CartController::class, 'proceedPayment']);
Route::get('order-summary', [CartController::class, 'orderDetail']);
Route::get('success', [CartController::class, 'success']);
Route::get('failed', [CartController::class, 'failed']);

Route::get('coupons', [CartController::class, 'viewCoupons']);
Route::post('select-coupons', [CartController::class, 'selectCoupon']);
Route::post('apply-coupon', [CartController::class, 'applyCoupon']);