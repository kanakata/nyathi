<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class LoginController
{
    public function index()
    {
        return view("user.auth.login");
    }

    public function login(Request $request)
    {
        // Handle login logic here
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // You can add authentication logic here, such as checking the credentials against the database
        $password = $validatedData['password'];
        $email = $validatedData['email'];

        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('/user/account');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
