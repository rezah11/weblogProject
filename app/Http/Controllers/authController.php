<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authController extends Controller
{
    //
    public function loginApi(Request $request)
    {
        auth()->attempt([
            'email' => $request->username,
            'password' => $request->password
        ]);

        if(auth()->check()){
            return auth()->user()->generateToken();
        }
        return response(['error'=>'اطلاعات کاربری را اشتباه وارد کرده اید'],401);
    }

    public function logoutApi()
    {
        $user=auth()->guard('api')->user();
        $user->logout();
        return $user;
    }
}
