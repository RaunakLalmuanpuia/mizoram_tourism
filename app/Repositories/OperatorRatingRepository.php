<?php

namespace App\Repositories;

use App\Interfaces\OperatorRatingRepositoryInterface;
use App\Models\OperatorRating;

class OperatorRatingRepository implements OperatorRatingRepositoryInterface 
{
    public function getAllModel(){
        return OperatorRating::all();
    }

      
    public function createModel(array $modelDetails){
        return OperatorRating::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return OperatorRating::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return OperatorRating::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return OperatorRating::destroy($modelId);

    }

}
