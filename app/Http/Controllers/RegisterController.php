<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'passwordConfirm' => 'required|same:password',
            'name' => 'required|min:6',
            'family' => 'required|min:6',
            'email' => 'required|unique:users|email:rfc,dns',
            'phone' => 'required|min:12|max:12',
            'birth' => 'required',
            ],
            [
                "login.required" => "Введите Имя для входа",
                "login.min" => "Длина Имени для входа должна быть 6 или больше",
                "password.required" => "Введите пароль",
                "password.min" => "Длина пароля должна быть 8 или больше",
                "passwordConfirm.required" => "Повторите пароль",
                "passwordConfirm.same" => "Пароли не совпадают",
                "name.required" => "Введите имя",
                "name.min" => "Длина имени должна быть 6 или больше",
                "family.required" => "Введите фамилию",
                "family.min" => "Длина фамилии должна быть 6 или больше",
                "email.required" => "Введите электронную почту",
                "email.email" => "Введите првильный адрес электронной почты",
                "phone.required" => "Ведите телефон",
                "phone.min" => "Неправильный номер телефона",
                "phone.max" => "Введите правильный номер",
                "date.required" => "Выберите дату"
            ]);
        $user = new User;
        $user->login = $request->get("login");
        $user->password = $request->get("password");
        $user->name = $request->get("name");
        $user->family = $request->get("family");
        $user->email = $request->get("email");
        $user->phone = $request->get("phone");
        $user->birth = $request->get("birth");
        $user->information = $request->get("information");
        $user->save();
        return redirect('/')->with('status', 'Form Data Has Been validated and insert');
    }
}
