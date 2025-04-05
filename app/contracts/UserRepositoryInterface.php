<?php

namespace App\contracts;
use App\Models\User;
use  App\Http\Requests\UpdateUSerRequest;
interface UserRepositoryInterface 
{
    public function getAllUsers() ;
    public function getUserById(User $user);
    public function updateUser(User  $user , UpdateUSerRequest $attributes);
    public function editeUser(User  $user);
    public function deleteUser(User $user);
    public function getUserByRole($role);
}
