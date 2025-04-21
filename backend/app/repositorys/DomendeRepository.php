<?php

namespace App\Repositorys;

use  App\Contracts\DomendeRepositoryInteface;
use App\Http\Requests\CreateDomendeRequest;
use  App\Models\Domende;
use  App\Models\User;

class DomendeRepository implements DomendeRepositoryInteface
{
    public function createDomende(CreateDomendeRequest $request)
    {
        Domende::create([
            'client_id' => $request->client_id,
            'annonce_id' => $request->annonce_id,
            'debu' => $request->debu,
            'fin' => $request->fin,
            'status' => $request->status ?? 'waiting',
        ]);
    }
    public function getDomendeByIdClient(string $id)
    {
        return Domende::where('client_id', $id)
        ->with(['annonces', 'users']) 
        ->get();
    }

    public function getDomendeByIdSeller(string $id) {}
    public function getDomendeByIdAnnonce(string $id) {}
    public function accepterDomende(string $id) {}
    public function refuserDemande(string $id) {}
}
