<?php

namespace App\Repositories;

use App\Interfaces\OccupancyDetailRepositoryInterface;
use App\Models\OccupancyDetail;

class OccupancyDetailRepository implements OccupancyDetailRepositoryInterface 
{
    public function getAllModel(){
        return OccupancyDetail::with('occupancy')->get();
    }

      
    public function createModel(array $modelDetails){
        //param1 IS USED FOR COTTAGE
        return OccupancyDetail::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return OccupancyDetail::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return OccupancyDetail::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return OccupancyDetail::destroy($modelId);

    }

}
