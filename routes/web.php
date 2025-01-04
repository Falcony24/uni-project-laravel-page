<?php

use App\Http\Controllers\AdminSubmitController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManagerController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckUser;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ShopController;

// profile
Route::middleware(CheckUser::class)->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ViewController::class, 'profileView'])->name('index');
    Route::get('/wishList', [ViewController::class, 'profileView'])->name('wishList');
});

// admin
Route::middleware(CheckAdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ViewController::class, 'adminView'])->name('index');
    Route::get('/submit', [AdminSubmitController::class, 'toDB'])->name('submitData');
    Route::get('/remove', [AdminSubmitController::class, 'deleteRow'])->name('deleteData');
});

// login/register forms
Route::get('/login', [ViewController::class, 'viewLogin'])
    ->middleware('guest')->name('login.view');
Route::post('/login', [AuthManagerController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthManagerController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/register', [AuthManagerController::class, 'register'])->name('register.post');
Route::get('/register', [ViewController::class, 'viewLogin'])
    ->middleware('guest')->name('register.view');

// shop
Route::get('/product/{product}', [ShopController::class, 'showProduct'])->name('shop.product');
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/wishlist/add/{product}', [WishListController::class, 'addToWishList'])->name('wishList.add');
Route::get('/sumarize', [])->name('cart.summarize');
Route::get('/{category}/{subCategory}', [ShopController::class, 'showProductCatalog'])->name('shop.catalog');
Route::get('/{category}', [ShopController::class, 'showCategoryCatalog'])->name('shop.categories');
Route::get('/', [ViewController::class, 'defaultPage'])->name('defaultPage');
