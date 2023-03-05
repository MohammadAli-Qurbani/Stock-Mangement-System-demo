<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentails = $request->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required']
        ]);


        if (!Auth::attempt($credentails)) {
            return response([
                'errors' => 'the credentials are not correct'
            ], 422);
        }
        $user = Auth::user();


        $token = $user->createToken('authToken')->plainTextToken;
        return response(
            [
                'user' => $user,
                'token' => $token
            ]
        );
    }


    public function logOut(){
        $user=Auth::user();
        $user->currentAccessToken()->delete();
        return response(['success'=>true]);
    }
}
