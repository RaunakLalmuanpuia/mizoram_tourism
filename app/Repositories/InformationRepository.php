<?php

namespace App\Repositories;

use App\Interfaces\InformationRepositoryInterface;
use App\Models\Information;

class InformationRepository implements InformationRepositoryInterface 
{
    public function getAllInformation(){
        return Information::all();
    }

      
    public function createInformation(array $informationDetails){
        return Information::create($informationDetails);

    }
    
    public function getInformationById($informationId){
        return Information::findOrFail($informationId);

    }
 
    public function updateInformation($informationId, array $newDetails){
        return Information::whereId($informationId)->update($newDetails);

    }

    public function deleteInformation($informationId){
        return Information::destroy($informationId);

    }

}
