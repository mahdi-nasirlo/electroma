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
use Modules\Service\Http\Controllers\ServiceController;

Route::prefix('service')->name("service.")->group(function () {
    Route::get('/service', [ServiceController::class, 'index'])->name('index');
    // Route::post('/service', [ServiceController::class, 'sort'])->name('sort');
});
