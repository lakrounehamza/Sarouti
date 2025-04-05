<?php

namespace App\Contracts;
use App\Models\Annonce;

interface AnnonceRepositoryInterface
{
public function getAllAnnonce();
public function getAnnonceById(Annonce  $annonce);

}
