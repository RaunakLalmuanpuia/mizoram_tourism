<?php

namespace App\Repositories;

use App\Interfaces\MizoramRepositoryInterface;
use App\Models\Mizoram;

class MizoramRepository implements MizoramRepositoryInterface 
{
    public function getAllMizoram(){
        return Mizoram::all();
    }

      
    public function createMizoram(array $MizoramDetails){
        return Mizoram::create($MizoramDetails);

    }
    
    public function getMizoramById($MizoramId){
        return Mizoram::findOrFail($MizoramId);

    }
 
    public function updateMizoram($MizoramId, array $newDetails){
        return Mizoram::whereId($MizoramId)->update($newDetails);

    }

    public function deleteMizoram($MizoramId){
        return Mizoram::destroy($MizoramId);

    }

}
