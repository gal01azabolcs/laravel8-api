<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function registration(Request $req){
        $validation = Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
         if($validation->fails()){
             return respone()->json($validation->errors(),202);
         }
         $sallData = $req->all();
         $sallData['password'] = bcrypt($sallData['password']);
         $user = User::create($sallData);
         $resArr = [];
         $resArr['token'] = $user->createToken('api-application')->accessToken;
         $resArr['name'] = $user->name;

         return response()->json($resArr,200);
    }

    public function login(Request $req){

        if(Auth::attempt([
            'email' => $req->email,
            'password' =>$req->password
       ])){
           $user = Auth::user();
           $resArr = [];
           $resArr['token'] = $user->createToken('api-application')->accessToken;
           $resArr['name'] = $user->name;
           return response()->json($resArr,200);
       }else{
        return response()->json(['error' => 'Unauthorized Acces'],203);
       }
    }
}
