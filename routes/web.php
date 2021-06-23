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
    Route::group([
       "middleware" => "auth"
    ], function() {
        Route::get("/dashboard", "App\Http\Controllers\ProfileController@dashboard")->name("dashboard");
        Route::get("/users", "App\Http\Controllers\ProfileController@users")->name("users");
        Route::get("/user/{id}",  "App\Http\Controllers\ProfileController@user")->name("user");
        Route::get("/objects", "App\Http\Controllers\IndexController@objects")->name("objects");
        Route::post("/addLocation", "App\Http\Controllers\IndexController@addLocation");
        Route::post("/removeLocation", "App\Http\Controllers\IndexController@removeLocation");
        Route::post("/updateLocation", "App\Http\Controllers\IndexController@updateLocation");
        Route::get("/getLocations", "App\Http\Controllers\IndexController@getLocations");
        Route::get("/messages", "App\Http\Controllers\MessageController@messages")->name("messages");
        Route::get("/message/{id}", "App\Http\Controllers\MessageController@messages")->name("dialog");
        Route::post("/message/{id}", "App\Http\Controllers\MessageController@sendMessage")->name("messageSend");
        Route::get("/profile/edit", "App\Http\Controllers\ProfileController@edit")->name("editProfile");
        Route::post("/profile/save", "App\Http\Controllers\ProfileController@saveProfile")->name("profileSave");
        Route::get("/password", "App\Http\Controllers\ProfileController@password")->name("changePassword");
        Route::post("/password/save", "App\Http\Controllers\ProfileController@savePassword")->name("passwordSave");
        Route::post("/changeHit", "App\Http\Controllers\ProfileController@changeHit");
    });

});
