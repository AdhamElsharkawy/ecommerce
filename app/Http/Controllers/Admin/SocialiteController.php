<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            // Retrieve user information from Google
            $socialUser = Socialite::driver($provider)->user();
            // dd($socialUser);
            // Look for the user in your database
            $user = Admin::where('social_id', $socialUser->getId())->where('social_type', $provider)->first();
            // dd($user);
            if (!$user) {
                $user = Admin::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'social_id' => $socialUser->getId(),
                    'social_type' => $provider,
                    'password' => bcrypt('unique_password'),
                    'image' => $socialUser->getAvatar(),
                    'status' => 1,
                    'type' => 'user'
                ]);
            }

            Auth::guard('admin')->login($user, true);
            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            // Redirect to the login page with an error message
            return redirect('admin/login')->with('error', 'Failed to log in with ' . ucfirst($provider) . '. Please try again.');
        }
    }
}
