<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function index() {
        return view("index");
    }

    public function dashboard()
    {
        if (Auth::id()) {
            $user = Auth::user();

            return view("dashboard", compact("user"));
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
    public function objects() {
        return view("objects");
    }
    public function addLocation(Request $request) {
        $latitude = $request->get("latitude");
        $longitude = $request->get("longitude");

    }
}
