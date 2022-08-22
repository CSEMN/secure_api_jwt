<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\Console\Output\ConsoleOutput;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function redirect(Request $request)
    {
        return Socialite::driver($request->provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $data = Socialite::driver($provider)->user();

        } catch (\Exception $e) {
            return back();
        }
        $user = $this->createOrUpdateUser($data, $provider);

        auth()->login($user,true);
        $token = JWTAuth::fromUser($user);
        return (new JWTController())->respondWithToken($token);
    }

    public function handel_oauth(Request $request,$provider){
        $data = json_decode($request->data)[0];
        $user = $this->createOrUpdateUser($data, $provider);

        auth()->login($user);
        $token = JWTAuth::fromUser($user);
        return (new JWTController())->respondWithToken($token);
    }

    private function createOrUpdateUser($data, $provider)
    {
        $user = User::where('provider_id', $data->id)->first();
        if (!$user) {
            $validator = Validator::make(
                ['email' => $data->email],
                ['email' => 'unique:users,email'],
                ['email.unique' => "Couldn't login, maybe you used another login method !"]);

            if ($validator->fails()) {
                return redirect('/home')->withErrors($validator);
            }

            $random_password = Str::random(10);
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'provider' => $provider,
                'provider_id' => $data->id,
                'email_verified_at' => now(),
                'password' => Hash::make($random_password),
            ]);
        }
        return $user;
    }
}
