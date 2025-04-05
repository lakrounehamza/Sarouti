<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Repositorys\AnnonceRepository;
use  App\Models\Annonce;
use  App\Http\Requests\CreateAnnonceRequest;
use  App\Http\Requests\UpdateAnnonceRequest;

class AnnonceController extends Controller
{
    private  $annonceRepository;
    public function  __construct(AnnonceRepository  $repository)
    {
        $this->annonceRepository =  $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces  =  $this->annonceRepository->getAllAnnonce();
        return  response()->json([
            'success' => true,
            'annonces' => $annonces
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAnnonceRequest $request) {
        try {
            $this->annonceRepository->createAnnonce($request);
            return  response()->json([
                'success' => true,
                'message' => 'Annonce created successfully'
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        try {
            $annonceGet = $this->annonceRepository->getAnnonceById($annonce);
            return  response()->json([
                'succes' => true,
                'message' => 'Annonce  get  successfully',
                'annonce' => $annonceGet
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'succes' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
