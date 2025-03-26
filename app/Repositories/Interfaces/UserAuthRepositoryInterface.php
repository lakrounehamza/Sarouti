<?php

namespace App\Repositories\Interfaces;

interface  UserAuthRepositoryInterface
{
  public function register(Array $attributes);
  public function  login (Array $attributes);
  public function  logout();
  public function  refrech();
}
