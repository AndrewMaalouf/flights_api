<?php

namespace App\Http\Controllers;

use DateTimeZone;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //
    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);

        if(!Auth::attempt($credentials)){
            return response()->json(['Message => wrong credentials'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Auth Token');
        $token = $tokenResult->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
