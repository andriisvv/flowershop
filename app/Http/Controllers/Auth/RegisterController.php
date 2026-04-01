<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => "Ім'я обов'язкове",
            'email.required'     => 'Email обов\'язковий',
            'email.unique'       => 'Цей email вже зареєстровано',
            'password.required'  => 'Пароль обов\'язковий',
            'password.min'       => 'Пароль мінімум 6 символів',
            'password.confirmed' => 'Паролі не співпадають',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('catalog');
    }
}