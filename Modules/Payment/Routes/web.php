<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\CartController;

Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/order/{order}', [CartController::class, 'payment'])->name('index');
    Route::get('/callback', [CartController::class, 'callback'])->name('callback');
    Route::get('/successful/{order}', [CartController::class, 'successful'])->name('successful');
    Route::get('/unsuccessful/{order}', [CartController::class, 'unsuccessful'])->name('unsuccessful');
});

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get("/", [CartController::class, 'index'])->name("index");
    // Route::get("/order/{order}", [CartController::class, "paymentPage"])->name("address");
    Route::get("/order", [CartController::class, "guestUserPay"])->name("guestPay");
});

Route::get('profile', [CartController::class, 'profile'])->middleware('auth')->name("profile");
