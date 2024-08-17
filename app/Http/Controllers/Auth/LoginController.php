<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $view_login = 'auth/';

    // Load view
    public function login() {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view($this->view_login . 'login');
        }
    }

    // Login process
    public function authenticate(Request $request) {
        $email = $request->input('user_mail');
        $password = $request->input('user_pass');

        // Determine of the login field is an email or a username
        $loginfield = filter_var($email, FILTER_VALIDATE_EMAIL)? 'user_mail' : 'user_name';

        // Attemot to authenticate with either email or username
        $data = [
            $loginfield => $email,
            'password' => $password,
        ];

        if (Auth::Attempt($data)) {
            return redirect('home');
        }else{
            return redirect()->back()->withErrors([
                'user_mail' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    // Logout Process
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // redirect
        return redirect()->route('login');
    }
}