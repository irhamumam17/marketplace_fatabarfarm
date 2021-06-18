<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StoreInformationController;


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

Route::get('/', [Controller::class,'index'])->name('user.home');
Route::get('/produk',[ProductController::class,'user_product'])->name('user.product');
Route::get('/produk/{id}',[ProductController::class,'user_product_detail'])->name('user.product_detail');
Route::get('/kategori/{id}',[ProductController::class,'user_category'])->name('user.category');
Route::get('/blogs',[PostController::class,'user_blog'])->name('user.blog');
Route::get('/blog/{id}',[PostController::class,'user_blog_detail'])->name('user.blog_detail');
Route::get('/sejarah',[StoreInformationController::class,'user_sejarah'])->name('user.history');
Route::get('/visi-misi',[StoreInformationController::class,'user_visi_misi'])->name('user.visi_misi');
Route::get('/lokasi',[StoreInformationController::class,'user_lokasi'])->name('user.location');
Route::middleware(['guest'])->group(function () {
    Route::get('/login',[AuthController::class,'loginView'])->name('login_view');
    Route::middleware(['throttle:login'])->group(function () {
        Route::post('/login',[AuthController::class,'login'])->name('login');
    });
    Route::get('/register',[AuthController::class,'registerView'])->name('register_view');
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::get('/password/forgot',[AuthController::class,'forgotPasswordView'])->name('forgot_password_view');
    Route::post('/password/forgot',[AuthController::class,'forgotPassword'])->name('forgot_password');

    Route::prefix('email')->name('email.')->group(function () {
        Route::get('/{token}/confirmation',[EmailController::class,'registerConfirmation'])->name('register_confirmation');
        Route::get('/{token}/reset-password',[EmailController::class,'resetPassword'])->name('reset_password');
    });
});
Route::get('/verification/notice',[AuthController::class,'verification_notice'])->name('verification.notice');
Route::middleware(['auth','verified','CheckRole:admin,customer'])->group(function(){
    Route::get('/transaksi',[TransactionController::class,'user_transaction'])->name('user.transaction');
    Route::get('/mycart',[CartController::class,'user_cart'])->name('user.cart');
    Route::get('/transaksi/{id}',[TransactionController::class,'user_transaction_detail'])->name('user.transaction_detail');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/cart/product/{id}/delete',[CartController::class,'user_delete_cart_product'])->name('user.delete_cart_product');
    Route::get('/cart/product/delete',[CartController::class,'user_delete_all_cart_product'])->name('user.delete_all_cart_product');
    Route::get('/profil',[UserController::class,'user_profil'])->name('user.profil');
    Route::post('/profil/update',[UserController::class,'user_profil_update'])->name('user.profil.update');
    Route::get('/pesanan/lacak',[UserController::class,'user_track_order_view'])->name('user.track_order.view');
    Route::post('/pesanan/lacak',[UserController::class,'user_track_order'])->name('user.track_order');
});
Route::middleware(['auth', 'verified','CheckRole:admin'])->group(function () {
    Route::get('/dashboard', [UserController::class,'admin_dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/get-data', [UserController::class,'getChartData'])->name('admin.dashboard.getdata');
    Route::get('users/admin', [UserController::class,'index_admin'])->name('admin.index');
    Route::get('users/admin/get', [UserController::class,'get_admin'])->name('admin.getdata');
    Route::get('users/customer', [UserController::class,'index_customer'])->name('customer.index');
    Route::get('users/customer/get', [UserController::class,'get_customer'])->name('customer.getdata');
    Route::resource('users', UserController::class)->except(['index','update']);
    Route::post('users/{id}',[UserController::class,'update'])->name('users.update');

    Route::resource('bank', BankController::class);
    Route::get('bank/get', [BankController::class,'get_data'])->name('bank.getdata');
    Route::resource('cart', CartController::class)->only(['index','create','edit','store','update','destroy']);
    Route::get('cart/get', [CartController::class,'get_data'])->name('cart.getdata');
    Route::resource('configuration', ConfigurationController::class);
    Route::get('configuration/ui', [ConfigurationController::class,'index_ui'])->name('config.ui');
    Route::get('configuration/fcm', [ConfigurationController::class,'index_fcm'])->name('config.fcm');
    Route::get('configuration/pusher', [ConfigurationController::class,'index_pusher'])->name('config.pusher');
    Route::resource('email', EmailController::class);
    Route::get('email/get', [EmailController::class,'get_data'])->name('email.getdata');
    Route::resource('notification', NotificationController::class);
    Route::get('notification/get', [NotificationController::class,'get_data'])->name('notification.getdata');
    Route::prefix('product')->name('product.')->group(function () {
        Route::resource('category', ProductCategoryController::class)->only(['index','create','edit','store','update','destroy']);
        Route::get('/category/get', [ProductCategoryController::class,'get_data'])->name('category.getdata');
        Route::resource('varian', ProductVariantController::class)->only(['index','store','create','edit','destroy']);;
        Route::post('varian/{id}',[ProductVariantController::class,'update'])->name('varian.update');
        Route::get('get', [ProductController::class,'get_data'])->name('getdata');
        Route::get('/varian/get', [ProductVariantController::class,'get_data'])->name('varian.getdata');
        Route::get('pending',[TransactionController::class, 'index_pending'])->name('pending.index');
        Route::get('success',[TransactionController::class, 'index_success'])->name('success.index');
        Route::get('cancel',[TransactionController::class, 'index_cancel'])->name('cancel.index');
        Route::get('konfirmasi',[TransactionController::class, 'index_konfirmasi'])->name('konfirmasi.index');
        Route::get('packing',[TransactionController::class, 'index_packing'])->name('packing.index');
        Route::get('dikirim',[TransactionController::class, 'index_dikirim'])->name('dikirim.index');
        Route::get('pending/get',[TransactionController::class, 'get_pending'])->name('pending.getdata');
        Route::get('success/get',[TransactionController::class, 'get_success'])->name('success.getdata');
        Route::get('cancel/get',[TransactionController::class, 'get_cancel'])->name('cancel.getdata');
        Route::post('upload-image',[ProductController::class, 'upload_image']);
    });
    Route::resource('product', ProductController::class);
});
