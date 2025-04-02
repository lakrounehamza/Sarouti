<?php

namespace App\contracts;
use  App\Http\Requests\RegisterRequest;
use  App\Http\Requests\LoginRequest;
interface AuthRepositoryInterface
{
 public function login(LoginRequest $attributes);
 public function register(RegisterRequest $attributes);
 public function logout();
 public function  refresh();
 public function forgot();
 public function reset();
}
