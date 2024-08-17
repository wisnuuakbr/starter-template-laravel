<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $view_register = 'auth/';

    // Generate the ID for Users
    private function generateUserId()
    {
        // Get last user_id from db
        $lastUser = User::orderBy('user_id', 'desc')->first();

        // If user == empty create id from '01001'
        if (!$lastUser) {
            return '01001';
        }

        // Get last id, increment +1
        $lastId = intval($lastUser->user_id);
        $newId = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        return $newId;
    }

    // Load view
    public function register()
    {
        return view($this->view_register . 'register');
    }

    // Store data to database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_mail' => 'required|string|email|max:255|unique:users,user_mail',
            'user_pass' => 'required|string|min:8',
            'password_confirmation' => 'required|same:user_pass'
        ]);

        // Store data to db
        User::create([
            'user_id'   => $this->generateUserId(),
            'user_name' => $request->user_name,
            'user_mail' => $request->user_mail,
            'user_pass' => Hash::make($request->user_pass),
        ]);

        // Redirect to login page after successful registration
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
