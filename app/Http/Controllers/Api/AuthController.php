<?php

namespace App\Http\Controllers\Api;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            "username" => "required|unique:users",
            "email" => "required|unique:users",
            "password" => "required|confirmed",
            "password_confirmation" => "required"
        ]);

        $validate['password'] = bcrypt($validate['password']);

        $user = User::create($validate);

        $accessToken = $user->createToken('authToken')->accessToken;
        return ['user' => $user, 'access_token' => $accessToken];
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($validate)) {
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return ['user' => auth()->user(), 'access_token' => $accessToken];
        } else {
            return response()->json(['message' => 'the username or password is not valid'],404);
        }
    }
}
