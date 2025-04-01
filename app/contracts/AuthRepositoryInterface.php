<?php

namespace App\contracts;
use  App\Http\Requests\RegisterRequest;
interface AuthRepositoryInterface
{
 public function login(array $attributes);
 public function register(RegisterRequest $attributes);
 public function logout();
 public function  refresh();
 public function forgot();
 public function reset();
}
