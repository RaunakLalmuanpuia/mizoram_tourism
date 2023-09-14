<?php

namespace App\Repositories;

use App\Interfaces\HiringRepositoryInterface;
use App\Models\Hiring;

class HiringRepository implements HiringRepositoryInterface 
{
    public function getAllHiring(){
        return Hiring::all();
    }

      
    public function createHiring(array $HiringDetails){
        return Hiring::create($HiringDetails);

    }
    
    public function getHiringById($HiringId){
        return Hiring::findOrFail($HiringId);

    }
 
    public function updateHiring($HiringId, array $newDetails){
        return Hiring::whereId($HiringId)->update($newDetails);

    }

    public function deleteHiring($HiringId){
        return Hiring::destroy($HiringId);

    }

}
