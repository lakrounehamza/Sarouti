<?php

namespace App\contracts;

interface AuthRepositoryInterface
{
 public function login();
 public function register();
 public function logout();
 public function  refresh();
 public function forgot();
 public function reset();
}
