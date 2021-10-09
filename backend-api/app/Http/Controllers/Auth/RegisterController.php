<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function checkUsername(Request $request)
    {
        $user = User::where('username',$request->username)->select('username')->first();
        if ($user) {
            return response()->json([
                'status'=>'false',
                'message'=>'Username Aleready taken.'
            ],404);
        }
        return response()->json([
            'status'=>'ok',
            'message'=>'Username useable.'
        ],200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullName'=>'required|max:30',
            'username'=>'required|max:25|min:5:unique:users,username',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
        ]);

        User::create([
            'fullName'=>$request->fullName,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
            'type'=>'0',
            'profilePhoto'=>'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg',
        ]);
    }
}
