<?php

use App\Http\Controllers\AdminSubmitController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManagerController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckUser;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ShopController;

// profile
Route::middleware(CheckUser::class)->prefix('profile')->name('profile.')->group(function () {
    Route::get('/{any}', [ProfileController::class, 'index'])->name('index');
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/addresses', [ProfileController::class, 'addAddress'])->name('address');
});

// admin
Route::middleware(CheckAdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ViewController::class, 'adminView'])->name('index');
    Route::post('/submit', [AdminSubmitController::class, 'toDB'])->name('submitData');
    Route::delete('/remove', [AdminSubmitController::class, 'deleteRow'])->name('deleteRow');
    Route::post('/edit', [AdminSubmitController::class, 'editRow'])->name('editRow');
    Route::put('/edit/row', [AdminSubmitController::class, 'editRowSubmit'])->name('editRowSubmit');
});

// login/register forms
Route::get('/login', [ViewController::class, 'viewLogin'])
    ->middleware('guest')->name('login.view');
Route::post('/login', [AuthManagerController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthManagerController::class, 'logout'])
    ->middleware('auth')->name('logout');
Route::post('/register', [AuthManagerController::class, 'register'])->name('register.post');
Route::get('/register', [ViewController::class, 'viewLogin'])
    ->middleware('guest')->name('register.view');

// shop
Route::get('/product/{product}', [ShopController::class, 'showProduct'])->name('shop.product');
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/delivery', [DeliveryController::class, 'index'])->name('cart.delivery');
Route::get('/summarize', [])->name('cart.summarize');
Route::post('/wishlist/add/{product}', [WishListController::class, 'addToWishList'])->name('wishList.add');
Route::get('/{category}/{subCategory}', [ShopController::class, 'showProductCatalog'])->name('shop.catalog');
Route::get('/{category}', [ShopController::class, 'showCategoryCatalog'])->name('shop.categories');
Route::get('/', [ViewController::class, 'defaultPage'])->name('defaultPage');
