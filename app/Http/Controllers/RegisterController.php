<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class RegisterController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return view("register");
    }

    public function register(Request $request) {
        $validatedData = $request->validate([
            'login' => 'required|min:6',
            'password' => 'required|min:8',
            'passwordConfirm' => 'required|min:8',
            'name' => 'required|min:6',
            'family' => 'required|min:6',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|min:11',
            'date' => 'required',
            ],
            [
                "login.required" => "Заполните поле Имя для входа",
                "login.min" => " Длина Имени для входа должна быть 6 или больше",
                "name.required" => "Заполните поле Имя"
            ]);
        return redirect('/')->with('status', 'Form Data Has Been validated and insert');
    }
}
