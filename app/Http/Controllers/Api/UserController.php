<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $validate = $request->validate([
                'password' => 'required',
                'new_password' => 'required|confirmed',
                'new_password_confirmation' => 'required'
            ]);

            $user->password = bcrypt($validate['new_password']);

            if ($user->save()) {
                return ['message' => 'Password updated successfully'];
            } else {
                return response()->json(['message' => 'Some error happened, please try again'], 500);
            }
        } else {
            return response()->json(['message' => 'Your current password is incorrect'], 401);
        }
    }
    public function updateProfile(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users,username,' . auth()->id(),
            'email' => 'required|unique:users,email,' . auth()->id(),
            'name' => 'required'
        ]);

        if (auth()->user()->update($validate)) {
            return ['message' => 'Updated successfully'];
        } else {
            return response()->json(['message' => 'try again later'], 500);
        }
    }
}
