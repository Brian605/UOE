<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = \App\Models\User::query()->where('email', $email)->first();
        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return to_route('dashboard')->with([
                "message" => "Login successful",
                "success" => true
            ]);
        }
        dd($user);
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
