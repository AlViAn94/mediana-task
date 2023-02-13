<?php

namespace App\Http\Controllers;

use Database\Factories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authenticate(Request $request){
        $credentials = request(['email', 'passwor']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function onlyAuth(Request $request){


        return response()->json(['aaa' => 'a1']);
    }
    public function registr(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required|min:2|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:3|max:100'
        ]);
        if ($validator->fails()){
            return response()->json([
                'massage'=>'Validation fails',
                'errors'=>$validator->errors() 
            ],422);
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
            return response()->json([
                'massage'=>'Registration successfull',
                'data'=>$user
            ],200);
     }
}

