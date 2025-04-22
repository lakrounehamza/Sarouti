<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositorys\DomendeRepository;
use App\Http\Requests\CreateDomendeRequest;

class DomendeController extends Controller
{
    private $domendeRepository;
    public function __construct(DomendeRepository $domendeRepository)
    {
        $this->domendeRepository = $domendeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $domendes = $this->domendeRepository->getAllDomendes();
            return response()->json([
                'success' => true,
                'data' => $domendes,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve domendes.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDomendeRequest $request)
    {
        try {
            $this->domendeRepository->createDomende($request);
            return response()->json([
                'success' => true,
                'message' => 'Domende created successfully.',
                // 'data' => $domende
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Domende.',
                'error' => $e->getMessage()
            ], 500);
        }

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
 
 
    public  function  getDomendesByClient(string  $id)
    {
        try {
            // Appel au repository pour récupérer les demandes du client
            $domendes = $this->domendeRepository->getDomendeByIdClient($id);

            // Vérifiez si des demandes existent pour ce client
            if ($domendes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No domendes found for this client.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $domendes,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve domendes for the client.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function acceptDomende(string $id)
    {
        try {
            $domende = $this->domendeRepository->accepterDomende($id);
            return response()->json([
                'success' => true,
                'message' => 'Domende accepted successfully.',
                'data' => $domende,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to accept Domende.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function rejectDomende(string $id)
    {
        try {
            $domende = $this->domendeRepository->refuserDemande($id);
            return response()->json([
                'success' => true,
                'message' => 'Domende rejected successfully.',
                'data' => $domende,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject Domende.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getDomendesBySeller(string $sellerId)
    {
        try {
            $domendes = $this->domendeRepository->getDomendeByIdSeller($sellerId);
    
            if ($domendes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No domendes found for this seller.',
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'data' => $domendes,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve domendes for the seller.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
