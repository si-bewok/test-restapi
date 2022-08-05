<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Public route
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/signin', [UserController::class, 'signin']);

// Protected route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/shopping', [ShoppingController::class, 'index']);
    Route::get('/shopping/{shopping}', [ShoppingController::class, 'show']);
    Route::post('/shopping', [ShoppingController::class, 'store']);
    Route::put('/shopping/{shopping}', [ShoppingController::class, 'update']);
    Route::delete('/shopping/{shopping}', [ShoppingController::class, 'destroy']);
});
