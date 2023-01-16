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

Route::prefix('blog')->group(function () {
    Route::get('/{post:slug}', [articleController::class, 'show'])->name('article.single');
    Route::get('/category/{category:slug}', [articleController::class, 'list'])->name('article.list');
});
