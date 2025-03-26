<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        return  response()->json(["message" => "register user " ]);
    }
    public function login(Request $request)
    {
        $validateRequest  = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email','=',$validateRequest['email'])->first();
        if(!$user)
            return  response()->json(["message" => "cette email n'existe pas "]);
            if (!Hash::check($validateRequest['password'], $user->password)) 
                return response()->json(["message" => "Mot de passe incorrect"], 401);

                $token = $user->createToken($user->name)->plainTextToken;
            return response()->json(["message" => "login user " ]);         


    }
    public function logout() {}
}
