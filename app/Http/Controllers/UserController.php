<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $this->validate($request,[
           'name'=>'string|required',
           'email'=>'email|required',
           'phone'=>'string|required',
           'player'=>'string|required',
           'password'=>'string|required'
        ]);
        if (User::all()->where('email','=',\request('email'))->count() > 0) {
            return response()->json(['status'=>false,'message'=>'This email is already registered on DistressPlus']);
        }
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'player' => $request['player'],
            'password' => Hash::make($request['password']),
        ]);
        $token = $user->createToken($user->name)->accessToken;
        return response()->json(['status'=>true,'user'=>$user,'token'=>$token])->setStatusCode(201,"Resource Created");
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'email|required',
            'password'=>'string|required'
        ]);
        if (User::all()->where('email','=',\request('email'))->count() > 0){
            $user = User::all()->where('email','=',\request('email'))->first();
            if (Hash::check(\request('password'),$user->password)){
                $token = $user->createToken(\request('email'))->accessToken;
            } else {
                return response()->json(['status'=>false,'message'=>'You have entered wrong login details']);
            }
        }else{
            return response()->json(['status'=>false,'message'=>'You have entered wrong login details','error' => 'Unauthorized'], 401);
        }
        return response()->json(['status'=>true,'user'=> $user,'token'=> "Bearer ".$token]);
    }
}
