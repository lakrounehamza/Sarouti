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
    public function  __construct(AnnonceRepository  $repository, ImageAnnonceRepository $imageAnnonceRepository, LikeRepository $likeRepository)
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
    public function store(CreateAnnonceRequest $request)
    {
        try {
            $this->annonceRepository->createAnnonce($request);

            //  $annonceId = $this->annonceRepository->getLastInsertedId();

            return response()->json([
                'success' => true,
                'message' => 'Annonce created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Annonce not created: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($annonceId)
    {
        try {
            $annonce = $this->annonceRepository->getAnnonceById($annonceId);
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
    public function destroy($annonceId)
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
            $annonces = $this->annonceRepository->getAnnonceBySedllerId($sellerId);
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
    public function getCommentsByAnnonceId($annonceId)
    {
        try {
            $comments = $this->annonceRepository->getCommentsByAnnonceId($annonceId);
            return  response()->json([
                'success' => true,
                'message' => 'Comments retrieved successfully',
                'comments' => $comments
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function statisticSeller($id)
    {
        try {
            $statistics = $this->annonceRepository->statisticSeller($id);
            return response()->json([
                'success' => true,
                'message' => 'Statistics retrieved successfully',
                'statistics' => $statistics
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve statistics: ' . $e->getMessage()
            ]);
        }
    }
    function  annoncesForAdmin(){
        try {
            $annonce = $this->annonceRepository->annoncesForAdmin();
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
    function  acceptAnnonce($id){
        try {
            $annonce = $this->annonceRepository->acceptAnnonce($id);
            return  response()->json([
                'succes' => true,
                'message' => 'Annonce  accept  successfully',
                'annonce' => $annonce
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'succes' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    function  rejectAnnonce($id){
        try {
            $annonce = $this->annonceRepository->rejectAnnonce($id);
            return  response()->json([
                'succes' => true,
                'message' => 'Annonce  reject  successfully',
                'annonce' => $annonce
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'succes' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    function  satatisticAdmin(){
        try {
            $satatistic = $this->annonceRepository->satatisticAdmin();
            return  response()->json([
                'succes' => true,
                'message' => 'satatistic ',
                'annonce' => $satatistic
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'succes' => false,
                'message' => $e->getMessage()
            ]);
        }
    } 
}
