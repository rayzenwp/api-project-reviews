<?php

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Auth\ApiAuthController;


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

Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('/reviews', [ReviewController::class, 'index']);
        Route::post('/reviews', [ReviewController::class, 'store']);

        Route::get('/reviews/{review}', [ReviewController::class, 'show']);
        Route::post('/reviews/{review}', [ReviewController::class, 'update']);
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

        Route::get('/user', [UserController::class, 'show']);
        Route::post('/logout', [ApiAuthController::class, 'logout']);
    });

    Route::post('/login', [ApiAuthController::class, 'login']);
});
