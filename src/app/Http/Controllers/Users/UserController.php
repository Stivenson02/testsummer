<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Exception;

class UserController extends Controller
{
    public function show()
    {
        $user=Auth::user();
        $user->detail;
        return $user;
    }

    public function store(Request $request)
    {
        try {
            $data=$request->all();
           $detail=UserDetail::where('user_id',Auth::user()->id);
           if ($detail->exists()){
               $detail=$detail->first();
           }else{
               $detail= new UserDetail();
               $detail->user_id=Auth::user()->id;
           }
            $detail->name=$data['name'];
            $detail->last_name=$data['last_name'];
            $detail->address=$data['address'];
            $detail->year=$data['year'];

            $detail->save();

            return response([
                "message"=>"Informacion almacenada"
            ],200);
        }catch (Exception $e){
            return response([
                "message"=>"No fue posible almacenar los campos" +$e
            ],401);

        }
    }
}
