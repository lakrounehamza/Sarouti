<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositorys\UserRepository;
use App\Models\User;
use App\Http\Requests\UpdateUserREquest;
class UserController extends Controller
{
    protected  $userRepository;
    /**
     * Display a listing of the resource.
     */
    public function __construct(UserRepository  $repository){
        $this->userRepository =  $repository;
    }
    public function index()
    {
        $data  =  $this->userRepository->getAllUsers();
        return  response()->json([
            'success' =>true,
            'message'=>'get  all  users',
            'users' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->getUserById($id);
        return  response()->json([
            'success'=> true, 
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserREquest $request, User $user)
    {
        $this->userRepository->updateUser($user , $request);
        return  response()->json([
            'success' =>true , 
            'message' => 'user updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userRepository->deleteUser($user);
        return  response()->json([
            'success' => true,
            'message' => 'utilisateur  suppimer  avec  sussce'
        ]);
    }
    public function suspendreUser($id)
{
    try {
        $user = $this->userRepository->suspendreUser($id);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur suspendu avec succès',
                'user' =>$user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Utilisateur introuvable'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue: ' . $e->getMessage()
        ], 500);
    }
}

public function actifUser($id)
{
    try {
        $user = $this->userRepository->actifUser($id);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur activé avec succès'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Utilisateur introuvable'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue: ' . $e->getMessage()
        ], 500);
    }
}
}
