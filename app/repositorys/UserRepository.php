<?php

namespace App\repositorys;
use App\Contracts\UserRepositoryInterface;
use  App\Models\User;
class UserRepository  implements  UserRepositoryInterface
{

    public function getAllUsers() {
        $users = User::all();
        return  $users;
    }
    public function getUserById(User  $user){
        return  $user;
    }
    public function updateUser(User  $user){}
    public function editeUser(User  $user){}
    public function deleteUser(User $user,array $attributes){}
    public function getUserByRole($role){}
}
