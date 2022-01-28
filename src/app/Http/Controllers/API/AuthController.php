<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use phpseclib\Crypt\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|max:255',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|confirmed'
        ] );

        $validateData['password'] = \Illuminate\Support\Facades\Hash::make($request->password);

        $user=User::created($validateData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user'=>$user,
            'access_token' => $accessToken
        ]);
    }
}
