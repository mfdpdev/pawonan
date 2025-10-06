<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showSignInForm()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        $remember = $request->has("rememberMe");
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->intended('/blogs');
        }

        return back()->withErrors([
            'email' => 'Email or password is wrong.',
        ])->onlyInput('email');
    }

    public function showSignUpForm()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'password' => Hash::make($data["password"]),
        ]);

        return redirect('/blogs');
    }

    public function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/signin');
    }
}
