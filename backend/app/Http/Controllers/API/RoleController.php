<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('status', 'encour')->get();
        return response()->json([
            'success' => true,
            'data' => $roles,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $role = Role::create([
                'user_id' =>  $request->id
            ]);
            return response()->json([
                'success' => true,
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the role.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $role = Role::where('user_id', $id);
            return response()->json([
                'success' => true,
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving the role.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        try {
            $role = Role::find($id);
            $role->delete();
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the role.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public  function  acceptRole($id)
    {
        try {
            $role  = Role::find($id);
            $role->update(['status' => 'accept']);
            return response()->json([
                'success' => true,
                'message' => 'Role status updated to accept.',
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the role status.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public  function annuleRole($id)
    {
        try {
            $role  = Role::find($id);
            return response()->json([
                'success' => true,
                'message' => 'Role status updated to accept.',
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the role status.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
