<?php

namespace App\contracts;
use App\Models\User;
interface UserRepositoryInterface 
{
    public function getAllUsers() ;
    public function getUserById(User $user);
    public function updateUser(User  $user);
    public function editeUser(User  $user);
    public function deleteUser(User $user,array $attributes);
    public function getUserByRole($role);
}
