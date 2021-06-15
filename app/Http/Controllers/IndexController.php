<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $user = Auth::user();
        if(Auth::user()) {
            return view("profile", compact("user"));
        }
        return redirect("/login", 302, []);
    }

    public function userPage() {
        $user = Auth::user();
        return view("profile", compact("user"));
    }

    public function usersList(Request $request) {
        $name = $request->get("name");
        $email = $request->get("email");
        if($name !== null) {
            $users = User::where("name", $name)->get();
        }
        if($email !== null) {
            $users = User::where("email", $email)->get();
        }
        else {
            $users = User::orderBy("loginDate", "DESC")->get();
        }
        return view("users", compact("users"));
    }
    public function user($id) {
        $user = User::where("id", $id)->first();
        return view("profile", compact("user"));
    }
}
