<?php

use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// https://chatback-sarobidy.herokuapp.com/ https://git.heroku.com/chatback-sarobidy.git
// git push heroku main

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('dashboard', function ()  {return view('backoffice.index') ;})->name('dashboard');
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('index');
        Route::delete('/delete/{user}',[UserController::class,'destroy'])->name('delete');
    });
    Route::prefix('conversation')->name('conversation.')->group(function(){
        Route::get('/',[ChatController::class,'index'])->name('index');
        Route::post('/resete',[ChatController::class,'reseteTabele'])->name('resete');
    });
});
