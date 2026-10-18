<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class RegisterController
{
    public function index(){
        return view("user.auth.register");
    }

    public function register(Request $request)
    {
        // Handle registration logic here
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // You can add user creation logic here, such as saving the user to the database
        $user = new \App\Models\User();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        // Optionally, log the user in after registration
        auth()->login($user);

        return redirect()->route('user.account');
    }
}
