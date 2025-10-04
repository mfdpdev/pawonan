<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function showProfilePage()
    {
        return view('profiles.app', [
            'user' => Auth::user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $record = User::findOrFail($user->id);

        // 1. Validasi Input
        $request->validate([
            'name' => ['string', 'max:255'],
            'profileImage' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png'], // Maks 2MB
        ]);

        if(isset($request->name) && $request->name != $user->name)
        {
            $record->update([
                'name' => $request->name
            ]);
        }

        if(isset($request->profileImage))
        {
            dd("ok image");
        }

        return redirect()->route('profiles');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $record = User::findOrFail($user->id);

        $request->validate([
            'password' => 'confirmed|min:8'
        ]);

        if(!Auth::attempt(["password" => $request->password]))
        {
            $record->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('profiles');
    }
}
