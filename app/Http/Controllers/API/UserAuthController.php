<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use  App\Models\User;
use App\repositorys\AuthRepository;
use  App\Http\Requests\RegisterRequest;
use App\Exception\mailRegisterException;
class UserAuthController extends Controller
{
    private $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function  register(RegisterRequest $request){
        try {
            if(User::where('email', $request->email)->exists()) 
                throw new mailRegisterException("Email already exists");
            $user = $this->authRepository->register($request);
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user
            ], 200);
        }catch (mailRegisterException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        } 
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
