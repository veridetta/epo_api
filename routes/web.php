<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\RatingController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::group(['middleware' => 'auth:web'], function() {
    Route::resource('books', BookController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'listSubmitted'])->name('orders.submitted');
    Route::get('/finish', [App\Http\Controllers\OrderController::class, 'finish'])->name('orders.finish');
    Route::get('/proccess', [App\Http\Controllers\OrderController::class, 'proccess'])->name('orders.proccess');
    Route::get('firebase', [App\Http\Controllers\OrderController::class, 'firebase'])->name('orders.firebase');
});*/
 Route::resource('books', BookController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('ratings', RatingController::class);
    Route::resource('cats', CatController::class);
    Route::resource('foods', FoodController::class);

    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'listSubmitted'])->name('orders.submitted');
    Route::get('review/{id}', [App\Http\Controllers\RatingController::class, 'index']);
    Route::get('/finish', [App\Http\Controllers\OrderController::class, 'finish'])->name('orders.finish');
    Route::get('/proccess', [App\Http\Controllers\OrderController::class, 'proccess'])->name('orders.proccess');
    Route::get('firebase', [App\Http\Controllers\OrderController::class, 'firebase'])->name('orders.firebase');
    Route::get('/soal/{id}', [App\Http\Controllers\FoodController::class, 'soal'])->name('foods.soal');

    // // Route::middleware('auth')->group(function() {
        
    // // });
    // Route::resource('books', BookController::class)->middleware('auth:web');
