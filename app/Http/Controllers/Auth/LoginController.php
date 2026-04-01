<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return redirect()->route('catalog');
        }

        return back()->withErrors([
            'email' => 'Невірна електронна пошта або пароль.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('catalog');
    }
}