<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            return to_route('dashboard')->with([
                "message" => "Login successful",
                "success" => true
            ]);
        }
        return back()->with([
            "message" => "Invalid email or password",
            "success" => false
        ]);

    }

    public function register()
    {

    }

    public function registerStore()
    {

    }
}
