<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\User;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $validateRequest  = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'photo' => 'required',
        ]);
        User::create([
            "name" => $validateRequest['name'],
            "email" => $validateRequest['email'],
            "password" => $validateRequest['password'],
            "role" => $validateRequest['role'],
            "phone" => $validateRequest['phone'],
            "photo" => $validateRequest['photo'],
        ]);
        return  response()->json(["message" => "register"]);
    }
    public function login() {}
    public function logout() {}
}
