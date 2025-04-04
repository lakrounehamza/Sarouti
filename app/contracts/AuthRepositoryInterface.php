<?php

namespace App\contracts;
use  App\Http\Requests\RegisterRequest;
use  App\Http\Requests\LoginRequest;
use  App\Http\Requests\ForgotRequest;
use Illuminate\Http\Request;
interface AuthRepositoryInterface
{
 public function login(LoginRequest $attributes);
 public function register(RegisterRequest $attributes);
 public function logout();
 public function  refresh();
 public function forgot(ForgotRequest $attributes);
 public function reset(Request $request);
}
