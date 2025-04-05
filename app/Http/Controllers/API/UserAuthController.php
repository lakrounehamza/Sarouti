<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use  App\Models\User;
use App\repositorys\AuthRepository;
use  App\Http\Requests\RegisterRequest;
use  App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotRequest;
use App\Exception\MailRegisterException;
use App\Exception\PasswordException;
use App\Customs\Services\EmailVerificationService;
USE App\Http\Requests\VerifyEmailRequest;
class UserAuthController extends Controller
{
    private $authRepository;
    private $emailService;
    public function __construct(AuthRepository $authRepository ,EmailVerificationService $service)
    {
        $this->authRepository = $authRepository;
        $this->emailService = $service;
    }
    public function  register(RegisterRequest $request)
    {
        try {
            if (User::where('email', $request->email)->exists())
                throw new mailRegisterException("Email already exists");
            if (($errors = $request->validatePassword($request->password)) !== []) {
                throw new PasswordException(implode(", ", $errors));
            }
             $user = $this->authRepository->register($request);
            
            $this->emailService->sendVerificationEmail($user);
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user
            ], 200);
        } catch (mailRegisterException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        } catch (PasswordException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function login(LoginRequest $request)
    {
        
          $message = $this->authRepository->login($request);
          
        return  $message;
           
       
    }
    public function logout()
    {
            $message = $this->authRepository->logout();
            return $message;
        
    }
    public function refresh()
    {
       
            $message = $this->authRepository->refresh();
            return $message;
       
    }
    public function forgot(ForgotRequest $request)
    {
        $message = $this->authRepository->forgot($request);
        return $message;
    }
    public function  reste (Request $request){
        $message = $this->authRepository->reset($request);
        return $message;
    }
    public function verifyEmail(VerifyEmailRequest $request)
    {
        $message = $this->emailService->verifyEmail($request->email ,$request->token);
        return $message;
    }
}
