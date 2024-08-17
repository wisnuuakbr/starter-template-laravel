<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // protected view for reusable
    protected $view_dashboards = '/home';

    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        // Check if the user already exists in your database
        $existingUser = User::where('user_main', $user->user_mail)->first();

        if ($existingUser) {
            // Log in the existing user
            Auth::login($existingUser, true);
        } else {
            // Create a new user record
            $newUser = User::create([
                'user_name' => $user->user_name,
                'user_main' => $user->user_mail,
                'user_pass' => bcrypt('123456'),
                // Set any other fields you want to populate
            ]);

            // Log in the new user
            Auth::login($newUser, true);
        }

        // Redirect the user to the desired location after login
        return redirect($this->view_dashboards);
    }
}