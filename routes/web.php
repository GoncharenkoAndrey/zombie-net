<?php

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
Route::group(['middleware' => 'web'], function () {
    Route::get('/', "App\Http\Controllers\IndexController@index")->name("index");
    Route::get("/login", "App\Http\Controllers\LoginController@index")->name("loginForm");
    Route::get("/register", "App\Http\Controllers\RegisterController@index")->name("registerForm");
    Route::get("/logout", "App\Http\Controllers\LoginController@logout")->name("logout");
    Route::post("/login", "App\Http\Controllers\LoginController@login")->name("loginPost");
    Route::post("/register", "App\Http\controllers\RegisterController@register")->name("registerPost");
    Route::get("/dashboard", "App\Http\Controllers\ProfileController@dashboard")->name("dashboard")->middleware("auth");
    Route::get("/users", "App\Http\Controllers\ProfileController@users")->name("users")->middleware("auth");
    Route::get("/user/{id}",  "App\Http\Controllers\ProfileController@user")->name("user")->middleware("auth");
    Route::get("/objects", "App\Http\Controllers\IndexController@objects")->name("objects")->middleware("auth");
    Route::post("/addLocation", "App\Http\Controllers\IndexController@addLocation")->middleware("auth");
    Route::post("/removeLocation", "App\Http\Controllers\IndexController@removeLocation")->middleware("auth");
    Route::get("/getLocations", "App\Http\Controllers\IndexController@getLocations")->middleware("auth");
    Route::get("/messages", "App\Http\Controllers\MessageController@messages")->name("messages")->middleware("auth");
    Route::get("/message/{id}", "App\Http\Controllers\MessageController@messages")->name("dialog")->middleware("auth");
    Route::post("/message/{id}", "App\Http\Controllers\MessageController@sendMessage")->middleware("auth")->name("messageSend");
    Route::get("/profile/edit", "App\Http\Controllers\ProfileController@edit")->middleware("auth")->name("editProfile");
    Route::post("/profile/save", "App\Http\Controllers\ProfileController@saveProfile")->middleware("auth")->name("profileSave");
    Route::get("/password", "App\Http\Controllers\ProfileController@password")->middleware("auth")->name("changePassword");
    Route::post("/password/save", "App\Http\Controllers\ProfileController@savePassword")->middleware("auth")->name("passwordSave");
    Route::post("/changeHit", "App\Http\Controllers\ProfileController@changeHit")->middleware("auth");
});
