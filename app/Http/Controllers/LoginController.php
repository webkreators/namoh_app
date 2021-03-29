<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {
    
    public function login(Request $request) {
        return view('admin.login');
    }
    
    public function authenticate(Request $request) {
        $credentials = $request->only('user_name', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect()->back()->with('error.auth', 'Incorrect username password!');
        }
    }
    
    public function forgotPassword() {
        return view('admin.forgot_password');
    }
    
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
    
}
