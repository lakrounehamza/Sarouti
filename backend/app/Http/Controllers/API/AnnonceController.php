<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Repositorys\AnnonceRepository;
use  App\Models\Annonce;
use  App\Http\Requests\CreateAnnonceRequest;
use  App\Http\Requests\UpdateAnnonceRequest;
use  App\Repositorys\ImageAnnonceRepository;
use App\Http\Requests\CreateImageAnnonceRequest;
use App\Repositorys\LikeRepository;
class AnnonceController extends Controller
{
    private  $annonceRepository;
    private $imageAnnonceRepository;
    private  $likeRepository;
    public function  __construct(AnnonceRepository  $repository , ImageAnnonceRepository $imageAnnonceRepository ,LikeRepository $likeRepository)
    {
        $this->annonceRepository =  $repository;
        $this->imageAnnonceRepository =  $imageAnnonceRepository;
        $this->likeRepository =  $likeRepository;
        
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
            $likes = $this->likeRepository->getLikesByAnnonceId($annonce->id);
            $annonce->likes = $likes;
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
            $annonceId = $this->annonceRepository->getLastInsertedId();
            if ($images) {
                $imagePaths = array_map(function($img) {
                    return $img['path'] ;
                }, $images);
                foreach ($imagePaths as $image) {
                    $this->imageAnnonceRepository->createImage($image, $annonceId);                    
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
            $likes = $this->likeRepository->getLikesByAnnonceId($annonce->id);
            $annonce->likes = $likes;
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
    public function getAnnonceByCategoryName($categoryName)
    {
        try {
            $annonces = $this->annonceRepository->getAnnonceByCategoryName($categoryName);
            return  response()->json([
                'success' => true,
                'message' => 'Annonce retrieved successfully',
                'annonces' => $annonces
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function getAnnonceBySellerId($sellerId)
    {
        try {
            $annonces = $this->annonceRepository->getAnnonceBySellerId($sellerId);
            return  response()->json([
                'success' => true,
                'message' => 'Annonce retrieved successfully',
                'annonces' => $annonces
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
  
}
