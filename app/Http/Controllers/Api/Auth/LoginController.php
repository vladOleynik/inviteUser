<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @bodyParam  email string required email of user. Example: example@examle.com
     * @bodyParam  password string required  password of user. Example secret
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
                return Auth::user()->createToken('Bearer');
            }else{
                throw new \Exception('User don`t user =)');
            }
        } catch (\Throwable $exception) {
            return response(['status'=>'error', 'message'=>$exception->getMessage()]);
        }
    }
}
