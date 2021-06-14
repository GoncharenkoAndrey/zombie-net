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
    Route::get('/', "App\Http\Controllers\IndexController@index");
    Route::get("/login", "App\Http\Controllers\LoginController@index");
    Route::get("/register", "App\Http\Controllers\RegisterController@index");
    Route::post("/login", "App\Http\Controllers\LoginController@login");
    Route::post("/register", 'App\Http\Controllers\RegisterController@register');
    Route::get("/userpage", "App\Http\Controllers\IndexController@userPage")->middleware("auth");
    Route::get("/userslist", "App\Http\Controllers\IndexController@usersList")->middleware("auth");
    Route::get("/users/{id}",  "App\Http\Controllers\IndexController@user")->middleware("auth");
});
