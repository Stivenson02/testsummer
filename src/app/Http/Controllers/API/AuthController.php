<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validateData = $request->validate([
            'name'=>'required|max:255',
            'email'=> 'required|email',
            'password'=> 'required|confirmed'
        ] );
        $validateData['password'] = Hash::make($request->password);

        $user=new User();
        $user->name=$validateData['name'];
        $user->email=$validateData['email'];
        $user->password=$validateData['password'];
        $user->save();

        $accessToken = $user->createToken('authToken')->accessToken;


        return response([
            'user'=>$user,
            'access_token' => $accessToken
        ]);
    }
}
