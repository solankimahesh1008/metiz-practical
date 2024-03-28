<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=> 'required',
            'password' => 'required|string|min:6',
        ]);


        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return view('welcome');
        } else {
            return redirect()->back()->withInput()->withErrors(['username' => 'Invalid credentials']);
        }
    }
}
