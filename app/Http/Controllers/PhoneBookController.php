<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use App\Models\PhoneBookModel;

class PhoneBookController extends Controller
{
    function onInsert(Request $request): string
    {

        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($request->input("token"), new Key($key, 'HS256'));
        $decodedArray = (array)$decoded;
        $userName = $decodedArray['username'];
        $phoneBookData =
            [
                'username'=>$userName,
                'phone'=>$request->input("phone"),
                'name'=> $request->input("name"),
                'email'=>$request->input("email")
            ];
        $result = PhoneBookModel::insert($phoneBookData);
        if($result){
            return "Data Inserted Successful";
        }else{
            return "Failed to insert data!!";
        }

    }

    function onSelect(Request $request): bool|string
    {
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($request->input("token"), new Key($key, 'HS256'));
        $decodedArray = (array)$decoded;
        $userName = $decodedArray['username'];
        $UserData = PhoneBookModel::where(['username'=>$userName])->get();
        return $UserData;
    }

    function onDelete(Request $request){
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($request->input("token"), new Key($key, 'HS256'));
        $decodedArray = (array)$decoded;
        $email = $request->input("email");
        $userName = $decodedArray['username'];
        $isDelete = PhoneBookModel::where(['username'=>$userName, 'email'=>$email])->delete();

        if($isDelete){
            return "Delete Successful!!";
        }else{
            return "Delete Failed!!";
        }
    }
}
