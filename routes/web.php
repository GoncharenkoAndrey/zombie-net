<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
Route::group(['middleware' => 'web'], function () {
    Route::get('/', [IndexController::class, "index"]);
    Route::get("/login", [LoginController::class, "index"]);
    Route::get("/register", [RegisterController::class, "index"]);
    Route::post("/login", [LoginController::class, "login"]);
    Route::post("/register", 'App\Http\Controllers\RegisterController@register');
});
