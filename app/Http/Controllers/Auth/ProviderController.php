<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    //
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        try {

            $SocialUser = Socialite::driver($provider)->user();
            // if(User::where('email',$SocialUser->getEmail())->exists()){
            //     return redirect('/login')->withErrors(['email'=>'This email use different method to login']);
            // }
            $array = ['bear', 'dog', 'rabbit'];
            $randomElement = Arr::random($array);
            $user = User::where(['provider' => $provider, 'provider_id' => $SocialUser->id])->first();
            if (!$user) {
                $user = User::create([
                    "name" => $SocialUser->getName(),
                    "email" => $SocialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $SocialUser->getId(),
                    'provider_token' => $SocialUser->token,
                    'email_verified_at' => now(),
                    'avatar' => $randomElement


                ]);
            }
            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // $user = User::updateOrCreate([
        //     'provider_id' => $SocialUser->id,
        //     'provider' => $provider
        // ], [
        //     'name' => $SocialUser->name,
        //     'email' => $SocialUser->email,
        //     'provider_token' => $SocialUser->token,
        //     'provider_refresh_token' => $SocialUser->refreshToken,
        // ]);

        // Auth::login($user);

        // return redirect('/dashboard');
    }
}
