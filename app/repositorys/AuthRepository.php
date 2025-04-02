<?php

namespace App\repositorys;
use App\contracts\AuthRepositoryInterface;
use App\Models\User;
// use App\Http\Requests\Auth\LoginRequest;
use  App\Http\Requests\RegisterRequest;
use  App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
class AuthRepository  implements AuthRepositoryInterface
{
    public function login(LoginRequest $attributes){
        $user = User::where('email', $attributes->email)->first();
        if (!$user || !Hash::check($attributes->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
       
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
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
    public function logout(){
        $user = Auth::user();
        if ($user) {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }
    public function  refresh(){}
    public function forgot(){}
    public function reset(){}
}
