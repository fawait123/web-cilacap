<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function actionLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Username atau password tidak ditemukan']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['username' => 'Username atau password tidak ditemukan']);
        }

        Auth::login($user, true);

        return redirect()->back();
    }
}
