<?php

namespace App\contracts;
use App\Models\User;
use  App\Http\Requests\UpdateUSerRequest;
interface UserRepositoryInterface 
{
    public function getAllUsers() ;
    public function getUserById( $userId);
    public function updateUser( $userId , UpdateUSerRequest $attributes);
    public function editeUser( $userId);
    public function deleteUser( $userId);
    public function getUserByRole($role);
}
