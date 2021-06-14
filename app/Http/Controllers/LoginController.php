<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function index() {
        return view("login");
    }
    function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->generate();
            return redirect("/userpage", 302, []);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
