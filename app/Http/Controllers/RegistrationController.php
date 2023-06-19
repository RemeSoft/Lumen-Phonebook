<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationModel;

class RegistrationController extends Controller
{
    public function onRegister(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $city = $request->input('city');
        $username = $request->input('username');
        $password = $request->input('password');
        $gender = $request->input('gender');

        $userCount = RegistrationModel::where('username', $username)->count();

        if($userCount==0){ // NOT MATCHING: SO USER ARE NOT REGISTRED;
            $userData = ['first_name' => $request->input('first_name'), 'last_name' => $request->input('last_name'), 'city' => $request->input('city'), 'username' => $request->input('username'), 'password' => $request->input('password'), 'gender' => $request->input('gender')];
            $result = RegistrationModel::insert($userData);
            if($result){
                return "Registration successfully.";
            }else{
                return "Registration failed try again.";
            }
        }else{
            return "User already exists";
        }


    }
}