<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use App\Models\RegistrationModel;






class LoginController extends Controller
{


    public function TokenTest(): string
    {
        return "token is okay";
    }

    public function onLogin(Request $request): \Illuminate\Http\JsonResponse|string
    {
        $key = env('TOKEN_KEY');
        $username = $request->input('username');
        $password = $request->input('password');
        $userCount = RegistrationModel::where(['username'=>$username, 'password'=>$password])->count();

        if($userCount){

            $payload = [
                'username' => $username,
                'exp' => time() + 120, // 120 SECOND.
            ];

            $token = JWT::encode($payload, $key, 'HS256');

            return response()->json(['token' => $token, 'Status' => "Login successful"]);

        }else{
            return "Wrong Credentials";
        }
    }
}
