<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositorys\UserRepository;
use App\Models\User;
class UserController extends Controller
{
    protected  $userRepository;
    /**
     * Display a listing of the resource.
     */
    public function __construct(UserRepository  $repository){
        $this->userRepository;
    }
    public function index()
    {
        $data  =  $this->userRepository->getAllUset();
        return  response()->json([
            'success' =>true,
            'message'=>'get  all  users',
            'users' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        $user = $this->userRepository->getUserById($user);
        return  response()->json([
            'success'=> true,
            'message' => 'get user  by id ',
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
