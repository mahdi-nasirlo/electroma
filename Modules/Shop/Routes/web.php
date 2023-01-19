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
use Modules\Shop\Http\Controllers\ShopController;
use Modules\Shop\Http\Livewire\ProductList;

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('products/{category:slug}', [ShopController::class, 'list'])->name('product.list');
    Route::get('product/{product:slug}', [ShopController::class, 'show'])->name("product.single");
});
