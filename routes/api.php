<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\RatingController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('registerApp', [PassportAuthController::class, 'registerApp']);
Route::get('user', [PassportAuthController::class, 'index']);
Route::post('book', [PassportAuthController::class, 'book']);
Route::post('user/{id}', [PassportAuthController::class, 'update']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::post('loginApp', [PassportAuthController::class, 'loginApp']);
Route::post('token', [PassportAuthController::class, 'saveToken']);
Route::post('order', [OrderController::class, 'list']);
Route::post('cat', [CatController::class, 'list']);
Route::post('food', [FoodController::class, 'list']);
Route::post('rating', [RatingController::class, 'list']);
Route::post('rating/global', [RatingController::class, 'global']);
Route::post('rating/add', [RatingController::class, 'storeApp']);
Route::post('create-order', [OrderController::class, 'storeApp']);

Route::middleware('auth:api')->group(function() {
    Route::resource('orders', OrderController::class);
});


