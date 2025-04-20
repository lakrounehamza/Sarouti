<?php

namespace App\Contracts;


use App\Http\Requests\CreateDomendeRequest;
interface DomendeRepositoryInteface
{
    public function createDomende(CreateDomendeRequest $request);
    public function getDomendeByIdClient(string $id);
    public function getDomendeByIdSeller(string $id);
    public function getDomendeByIdAnnonce(string $id);
    public function accepterDomende(string $id);
    public function refuserDemande(string $id);
}
