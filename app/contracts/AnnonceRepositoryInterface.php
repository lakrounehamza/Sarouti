<?php

namespace App\Contracts;
use App\Models\Annonce;
use  App\Http\Requests\CreateAnnonceRequest;

interface AnnonceRepositoryInterface
{
public function getAllAnnonce();
public function getAnnonceById(Annonce  $annonce);
public function createAnnonce(CreateAnnonceRequest  $attributes);

}
