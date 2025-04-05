<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Repositorys\AnnonceRepository;
use  App\Models\Annonce;
use  App\Http\Requests\CreateAnnonceRequest;
use  App\Http\Requests\UpdateAnnonceRequest;
use  App\Repositorys\ImageAnnonceRepository;
class AnnonceController extends Controller
{
    private  $annonceRepository;
    private $imageAnnonceRepository;
    public function  __construct(AnnonceRepository  $repository , ImageAnnonceRepository $imageAnnonceRepository)
    {
        $this->annonceRepository =  $repository;
        $this->imageAnnonceRepository =  $imageAnnonceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces  =  $this->annonceRepository->getAllAnnonce();
        foreach ($annonces as $annonce) {
            $images = $this->imageAnnonceRepository->getAllImagesByAnnonceId($annonce->id);
            $annonce->images = $images;
        }
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
            $images = $request->images;
            if ($images) {
                foreach ($images as $path) {
                    $this->imageAnnonceRepository->createImage($path, $request->id);
                }
            }
            return  response()->json([
                'success' => true,
                'message' => 'Annonce created successfully'
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'success' => false,
                'message' => $e->getMessage(). '  Annonce not created'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $annonceId)
    {
        try {
            $annonce= $this->annonceRepository->getAnnonceById($annonceId);
            $images = $this->imageAnnonceRepository->getAllImagesByAnnonceId($annonce->id);
            $annonce->images = $images;
            return  response()->json([
                'succes' => true,
                'message' => 'Annonce  get  successfully',
                'annonce' => $annonce
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
    public function update(UpdateAnnonceRequest $request,  $annonceId)
    {
        try {
            $this->annonceRepository->UpdateAnnonce($annonceId, $request);
            return  response()->json([
                'success' => true,
                'message' => 'Annonce updated successfully'
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $annonceId)
    {
        try {
            $this->annonceRepository->deleteAnnone($annonceId);
            return  response()->json([
                'success' => true,
                'message' => 'Annonce deleted successfully'
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
  
}
