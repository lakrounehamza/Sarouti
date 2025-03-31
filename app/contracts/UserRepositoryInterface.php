<?php

namespace App\contracts;
use App\Models\User;
interface UserRepositoryInterface 
{
    public function getAllUsers() ;
    public function getUserById();
    public function updateUser(User  $user);
    public function editeUser(User  $user);
    public function createUser(array  $attributes);
    public function deleteUser(User $user,array $attributes);
    public function getUserByRole($role);
}
