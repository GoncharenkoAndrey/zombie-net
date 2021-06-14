<?php

namespace App\Http\Controllers;

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
        if(Auth::user()) {
            return view("user");
        }
        return redirect("/login", 302, []);
    }

    public function userPage() {
        return view("user");
    }

    public function usersList() {
        $users = User::orderBy("loginDate", "DESC")->get();
        return view("users", compact("users"));
    }
    public function user($id) {
        $user = User::where("id", $id)->first();
        return view("user", compact("user"));
    }
}
