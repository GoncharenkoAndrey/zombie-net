<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;
use Psy\Util\Json;

class ProfileController extends Controller
{
    public function dashboard()
    {
        if (Auth::id()) {
            $user = Auth::user();

            return view("profile", compact("user"));
        }
        else {
            redirect(route("index"));
        }
    }

    public function user($id) {
        $user = DB::table("users")->where("id", $id)->first();

        return view("profile", compact("user"));
    }

    public function users(Request $request) {
        $name = $request->get("name");
        $email = $request->get("email");
        $users = DB::table("users");
        if($name) {
            $users->where("name", $name);
        }
        if($email) {
            $users->where("email", $email);
        }
        $users = $users->get();

        return view("users", compact("users"));
    }

    public function edit() {
        $user = Auth::user();
        return view("edit",compact("user"));
    }

    public function password() {
        return view("password");
    }

    public function saveProfile(Request $request) {
        $validatedData = $request->validate([
            'login' => 'required|min:6',
            'name' => 'required|min:6',
            'family' => 'required|min:6',
            'email' => 'required|unique:users,email,' . Auth::id(),
            'phone' => 'required|min:12|max:12',
            'birth' => 'required',
            ],
            [
                "login.required" => "Введите Имя для входа",
                "login.min" => "Длина Имени для входа должна быть 6 или больше",
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
        $user = User::find(Auth::id());
        $user->name = $request->get("name");
        $user->family = $request->get("family");
        $user->email = $request->get("email");
        $user->phone = $request->get("phone");
        $user->birth = $request->get("birth");
        $user->information = $request->get("information");
        $user->update();
        return redirect()->route("dashboard");
    }

    public function savePassword(Request $request) {
        $validatedData = $request->validate([
            'password' => 'required|min:8',
            'passwordConfirm' => 'required|same:password'
        ]);
        $user = User::find(Auth::id());
        $user->password = bcrypt($request->get("password"));
        $user->update();
        return redirect()->route("dashboard");
    }

    public function changeHit(Request $request) {
        $data = json_decode($request->getContent());
        $user = User::find($data->userId);
        $user->eat = $data->value;
        $user->update();
        return $user->eat;
    }
}
