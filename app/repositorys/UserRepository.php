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
    public function updateUser( $userId,UpdateUSerRequest $attributes){
        $user = User::find($userId);
        if($user)
        $user->update($attributes->all());
    }
    public function editeUser(  $user){
      
    }
    public function deleteUser( $userId){
        $user = User::find($userId);
        if($user)
        $user->delete();
    }
    public function getUserByRole($role){
        $users =  User::where('role',$role);
        return  $users;
    }
}
