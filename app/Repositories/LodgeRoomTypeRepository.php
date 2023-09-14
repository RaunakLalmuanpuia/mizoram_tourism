<?php

namespace App\Repositories;

use App\Interfaces\LodgeRoomTypeRepositoryInterface;
use App\Models\LodgeRoomType;
use App\Models\LodgeRoomData;
use Illuminate\Support\Facades\Log;

class LodgeRoomTypeRepository implements LodgeRoomTypeRepositoryInterface 
{
    public function getAllLodgeRoomType(){
        return LodgeRoomType::all();
    }

      
    public function createLodgeRoomType(array $lodgeRoomTypeDetails){
        return LodgeRoomType::create($lodgeRoomTypeDetails);
    }
    
    public function getLodgeRoomTypeById($lodgeRoomTypeId){
        return LodgeRoomType::findOrFail($lodgeRoomTypeId);
    }
 
    public function updateLodgeRoomType($lodgeRoomTypeId, array $newDetails){
        return LodgeRoomType::whereId($lodgeRoomTypeId)->update($newDetails);
    }

    public function deleteLodgeRoomType($lodgeRoomTypeId){
        return LodgeRoomType::destroy($lodgeRoomTypeId);
    }

}
