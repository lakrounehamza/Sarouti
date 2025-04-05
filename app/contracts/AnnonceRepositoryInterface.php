<?php

namespace App\Contracts;
use App\Models\Annonce;
use  App\Http\Requests\CreateAnnonceRequest;
use  App\Http\Requests\UpdateAnnonceRequest;

interface AnnonceRepositoryInterface
{
public function getAllAnnonce();
public function getAnnonceById(Annonce  $annonce);
public function createAnnonce(CreateAnnonceRequest  $attributes);
public function UpdateAnnonce(Annonce $annonce ,UpdateAnnonceRequest  $attributes);
public function deleteAnnone(Annonce $annonce);

}
