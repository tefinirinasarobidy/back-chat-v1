<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/{user}',[ProfileController::class, 'profile']);
        Route::post('/update/{user}',[ProfileController::class, 'updateProfile']);
        Route::put('/update-info/{user}',[ProfileController::class,'updateInfo']);
    });
    Route::get('/all-user', [CustomerController::class, 'allUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

