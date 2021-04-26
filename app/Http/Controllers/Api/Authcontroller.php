<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;



class Authcontroller extends Controller
{
    public function login(request $request)
    {
        $creds = $request->only(['email','password']);

        if(!$token=auth()->attempt($creds))
        {
            return response()->json([
                'sucess'=> false,
                'message'=>'Invalid Login creds'

            ]);
        }
        return response()->json([
            'sucess'=> true,
            'token'=>$token,
            'user'=>Auth::user()

        ]);
    }
    public function register(request $request)
    {
        $encryptpass = Hash::make($request->password);

        $user = new User;
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $encryptpass;
            $user->save();
            return $this->login($request);
        } catch (Execption $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e
            ]);
        }
    }
    public function logout(request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success'=>true,
                'message'=>'Logged Out'
            ]);
        } catch (Execption $e) {
            return response()->json([
                'success'=>false,
                'message'=>$e
            ]);
        }
    }
}
