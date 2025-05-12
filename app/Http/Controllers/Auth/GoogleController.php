<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Find or create user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => encrypt('randomencryptedpassword')
                ]
            );
            
            // Log in the user
            Auth::login($user);
            
            return redirect()->intended('/dashboard');
            
        } catch (\Exception $e) {
            \Log::error('Google auth error: ' . $e->getMessage());
            return redirect('/')->with('error', 'Authentication failed. Please try again.');
        }
    }
}