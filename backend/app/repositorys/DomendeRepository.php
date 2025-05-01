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
            ->with(['annonce', 'client'])
            ->get();
    }

    public function getDomendeByIdSeller(string $id)
    {
        return Domende::whereHas('annonce', function ($query) use ($id) {
                $query->where('seller_id', $id);
            })
            ->where('status', '!=' ,'rejected') 
            ->with(['annonce', 'client'])
            ->get();
    }
    public function getDomendeByIdAnnonce(string $id)
    {
        return Domende::where('annonce_id', $id)
            ->with(['client', 'annonce'])
            ->get();
    }
    public function accepterDomende(string $id)
    {
        $domende = Domende::findOrFail($id); 
        $domende->status = 'accepted';  
        $domende->save();  
        return $domende;
    }
    public function refuserDemande(string $id)
    {
        $domende = Domende::findOrFail($id);  
        $domende->status = 'rejected';  
        $domende->save();  

        return $domende; 
    }
    public  function getAllDomendes(){
        return Domende::all(); 
    }
}
