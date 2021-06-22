<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        $cities = City::all();
        $name = $request->get("name");
        $email = $request->get("email");
        $city = $request->get("city");
        $cityId = City::where("name", $city)->first()->id;
        $users = DB::table("users");
        if($name) {
            $users->where("name", $name);
        }
        if($email) {
            $users->where("email", $email);
        }
        if($cityId) {
            $users->where("cityId", $cityId);
        }
        $users = $users->get();

        return view("users", compact("users", "cities"));
    }

    public function edit() {
        $user = Auth::user();
        return view("edit",compact("user"));
    }

    public function password() {
        return view("password");
    }
    function resize($image_id,$width,$height)
    {
        $new_width =$width * 0.5;
        $new_height =$height * 0.5;
        $layer=imagecreatetruecolor($new_width,$new_height);
        imagecopyresampled($layer,$image_id,0,0,0,0,$new_width,$new_height, $width,$height);
        return $layer;
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
        $city = $request->get("city");
        $cityModel = new City();
        $cityObject = $cityModel->where("name", $city)->first();
        if($cityObject) {
            $cityId = $cityObject->id;
        }
        else {
            $cityModel->name = $city;
            $cityModel->save();
            $cityId = $cityModel->id;
        }
        $user = User::find(Auth::id());
        $user->name = $request->get("name");
        $user->family = $request->get("family");
        $user->email = $request->get("email");
        $user->phone = $request->get("phone");
        $user->birth = $request->get("birth");
        $user->information = $request->get("information");
        $user->locationId = $request->get("locationId");
        $user->cityId = $cityId;
        if($request->hasFile("photo")) {
            $image = $request->file("photo");
            $destinationPath = "photos";
            $extension = $request->file("photo")->getClientOriginalExtension();
            $fileNameToStore = time() . '.' . $extension;
            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $fileNameToStore);
            $user->photo = $fileNameToStore;
        }
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
