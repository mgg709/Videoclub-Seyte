<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login'])->name('login');
Route::get('test', [RegisterController::class, 'test']);


Route::middleware('auth:api')->group(function () {
    Route::resource('peliculas', MovieController::class);
    Route::resource('resenas', ReviewController::class);
    Route::resource('alquiler', RentController::class);

});

Route::middleware('auth:api')->post('logout', [RegisterController::class, 'logout']);
