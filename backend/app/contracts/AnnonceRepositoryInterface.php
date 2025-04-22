<?php

namespace App\Contracts;
use  App\Http\Requests\CreateAnnonceRequest;
use  App\Http\Requests\UpdateAnnonceRequest;

interface AnnonceRepositoryInterface
{
public function getAllAnnonce();
public function getAnnonceById($annonceId);
public function createAnnonce(CreateAnnonceRequest  $attributes);
public function UpdateAnnonce($annonceId ,UpdateAnnonceRequest  $attributes);
public function deleteAnnone($annonceid);
public function getLastInsertedId();
public function getAnnonceByCategoryName($categoryName);
public function getAnnonceBySellerId($sellerId);
public  function statisticSeller($seller_id);
}
