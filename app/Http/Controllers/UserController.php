<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Helper\StoreFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile()
    {
        return new UserResource(auth()->user());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($request->hasFile('avatar')){
            //if image is added
            $avatar_path = StoreFile::store($request->file('avatar'), 'avatars');
            $user->update([
                'avatar'=>$avatar_path,
            ]);
        }
        return new UserResource($user);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|min:2|max:100',
            'email' => 'sometimes|required|string|email|max:100|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ], 400);
        }

        if ($request->name)
            $user->name = $request->name;
        if ($request->email)
            $user->email = $request->email;
        if ($request->password)
            $user->password = Hash::make($request->password);
        if ($request->hasFile('avatar')){
            if (Storage::exists($user->getOriginal('avatar'))) {
                Storage::delete($user->getOriginal('avatar'));
            }
            $user->avatar = StoreFile::store($request->file('avatar'), 'avatars');
        }

        if ($user->isDirty())
            $user->save();

        return new UserResource($user);
    }
}
