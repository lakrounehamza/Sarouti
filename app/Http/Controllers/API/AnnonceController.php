<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Repositorys\AnnonceRepository;

class AnnonceController extends Controller
{
    private  $annonceRepository;
    public function  __construct( AnnonceRepository  $repository){
        $this->annonceRepository =  $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $annonces  =  $this->annonceRepository->getAllAnnonce();
    return  response()->json([
        'success' => true ,
        'annonces' => $annonces 
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
