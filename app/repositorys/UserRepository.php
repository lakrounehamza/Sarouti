<?php

namespace App\repositorys;
use App\Contracts\UserRepositoryInterface;
use  App\Models\User;
use  App\Http\Requests\UpdateUserRequest;
class UserRepository  implements  UserRepositoryInterface
{

    public function getAllUsers() {
        $users = User::all();
        return  $users;
    }
    public function getUserById($userId){
        $user = User::find($userId);
        if($user)
        return  $user;
    }
    public function updateUser(User  $user,UpdateUSerRequest $attributes){
        $user->update($attributes->all());
    }
    public function editeUser(User  $user){
      
    }
    public function deleteUser(User $user){
        $user->delete();
    }
    public function getUserByRole($role){
        $users =  User::where('role',$role);
        return  $users;
    }
}
