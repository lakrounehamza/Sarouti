<?php

namespace App\repositorys;
use App\contracts\AuthRepositoryInterface;
use App\Models\User;
// use App\Http\Requests\Auth\LoginRequest;
use  App\Http\Requests\RegisterRequest;
use  App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
class AuthRepository  implements AuthRepositoryInterface
{
    public function login(LoginRequest $attributes){

    }
    public function register(RegisterRequest $attributes){
        User::create([
            'name' => $attributes->name,
            'email' => $attributes->email,
            'password' => bcrypt($attributes->password),
            'role' => $attributes->role,
            'phone' => $attributes->phone,
            'photo' => $attributes->photo,
        ]);
    }
    public function logout(){}
    public function  refresh(){}
    public function forgot(){}
    public function reset(){}
}
