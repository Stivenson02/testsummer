<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected function validator(array $data){
        return Validator::make($data,[
            'name'=>['required', 'string', 'max:255'],
            'last_name'=>['required', 'string', 'max:255'],
            'addres'=>['required', 'string', 'max:255'],

        ]);
    }

    public function user(Request  $request)
    {
        $user= $request->all();

        $user_detail=UserDetail::new();
        $user_detail->name=$user['name'];
        $user_detail->last_name=$user['last_name'];
        $user_detail->addres=$user['addres'];
        $user_detail->user_id=Auth::user()->id;
        $user_detail->save();


        return Response::json([
          'message'=> 'Registro completo'
        ],200);


    }

    public function getUser()
    {
        $user=Auth::user();
        return Response::json ([
            'user'=>$user,
            'detail'=>$user->user_detail()
        ],200);
    }
}
