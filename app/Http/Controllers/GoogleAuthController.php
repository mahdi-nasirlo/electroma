<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class GoogleAuthController extends Controller
{
    // use TwoFactorAuth;
    public function redirect()
    {
        return Socialite::driver("google")->redirect();
    }

    public function callback(Request $request)
    {


        try {
            $googleUser = Socialite::driver("google")->user();

            $user = User::where("email", $googleUser->email)->first();

            if (!$user) {
                $newUser = User::create([
                    "name" => $googleUser->name,
                    "avatar" => $googleUser->avatar,
                    "email" => $googleUser->email,
                    "password" => Hash::make(Str::random(8)),
                ]);
                $user = $newUser;
            }

            Auth::login($user);

            if ($user->canAccessFilament()) {
                return redirect(route('filament.pages.dashboard'));
            } else redirect(route("home"));
        } catch (\Throwable $th) {

            // Alert::error('خطایی رخ داده', 'لطفا مجددا تلاش بفرمایید');

            return redirect()->back();
        }
    }
}
