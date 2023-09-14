<?php

namespace App\Repositories;

use App\Interfaces\LodgeRatingRepositoryInterface;
use App\Models\LodgeRating;

class LodgeRatingRepository implements LodgeRatingRepositoryInterface 
{
    public function getAllModel(){
        return LodgeRating::all();
    }

      
    public function createModel(array $modelDetails){
        return LodgeRating::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return LodgeRating::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return LodgeRating::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return LodgeRating::destroy($modelId);

    }

}
