<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProviderController extends Controller
{
    public function redirect($provider){
         return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $googleUser = Socialite::driver($provider)->user();
        $user = User::updateOrCreate([
            'provider_id' => $googleUser->id,
            'provider' => $provider,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'provider_token' => $googleUser->token
        ]);
 
        Auth::login($user);
 
        return redirect('/inicio');
    }
}
