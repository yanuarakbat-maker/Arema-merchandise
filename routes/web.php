<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\NewsController;

// Home Arema Store
Route::get('/', [PublicController::class, 'home'])->name('home');

// Dashboard customer tanpa login
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Profile customer (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Public pages
Route::get('/products', [PublicController::class, 'products'])->name('products');
Route::get('/products/{id}', [PublicController::class, 'productShow'])->name('products.show');
Route::get('/product/{id}/detail', [PublicController::class, 'productDetail']);
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/news/{slug}', [PublicController::class, 'newsShow'])->name('news.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout & Order
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');

// Admin Auth & Dashboard
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.attempt');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('header', [\App\Http\Controllers\Admin\HeaderImageController::class, 'index'])->name('header.index');
    Route::post('header', [\App\Http\Controllers\Admin\HeaderImageController::class, 'update'])->name('header.update');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::delete('products/{product}/images/{image}', [\App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('products.deleteImage');
    Route::resource('news', NewsController::class)->except(['show']);
    Route::resource('standings', \App\Http\Controllers\Admin\StandingController::class)->except(['show']);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index','show','edit','update']);
});
