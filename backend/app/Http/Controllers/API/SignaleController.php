<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Signale;
class SignaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Signale::where('status', 'encour')->get();
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
            $role = Signale::create([
                'user_id' =>  $request->id
            ]);
            return response()->json([
                'success' => true,
                'data' => $role,
            ], 200);
        } catch (\Exception $e) { 
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Signale.',
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
            $role = Signale::where('user_id', $id);
            return response()->json([
                'success' => true,
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving the Signale.',
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
        //
    }
    public  function  acceptRole($id)
    {
        try {
            $role  = Signale::find($id);
            $role->update(['status' => 'accept']);
            return response()->json([
                'success' => true,
                'message' => 'user Signale accept.',
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
            $role  = Signale::find($id);
            return response()->json([
                'success' => true,
                'message' => 'user Signale accept.',
                'data' => $role,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the Signale status.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
