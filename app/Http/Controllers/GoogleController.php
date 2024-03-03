<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    const GOOGLE_TYPE = 'google'; 

    public function handleGoogleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        
            $userExisted = User::where('oauth_id', $user->id)->where('oauth_type', static::GOOGLE_TYPE)->first();
        
            if ($userExisted) {
                Auth::login($userExisted);
                return redirect()->route('dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
                    'oauth_type' => static::GOOGLE_TYPE,
                    'password' => Hash::make($user->id),
                ]);
                dd($newUser);

                Auth::login($newUser);
                
                return redirect()->route('home');
            }
        } catch (Exception $e) {
            return redirect()->route('login');
        }
    }
}

