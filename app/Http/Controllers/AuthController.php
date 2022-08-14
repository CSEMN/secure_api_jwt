<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
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

        }catch (\Exception $e){
            return redirect('/');
        }

        $user = $this->createOrUpdateUser($data, $provider);

//       auth()->login($user);
        $token = JWTAuth::fromUser($user);

        return (new JWTController())->respondWithToken($token);
    }

    private function createOrUpdateUser($data, $provider)
    {
        $user = User::where('provider_id', $data->id)->first();
        if (!$user) {
            $validator = Validator::make(
                ['email'=>$data->email],
                ['email'=>'unique:users,email'],
                ['email.unique'=>"Couldn't login, maybe you used another login method !"]);

            if ($validator->fails()){
                return redirect()->withErrors($validator);
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
