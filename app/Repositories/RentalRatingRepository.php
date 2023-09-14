<?php

namespace App\Repositories;

use App\Interfaces\RentalRatingRepositoryInterface;
use App\Models\RentalRating;

class RentalRatingRepository implements RentalRatingRepositoryInterface 
{
    public function getAllModel(){
        return RentalRating::all();
    }

      
    public function createModel(array $modelDetails){
        return RentalRating::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return RentalRating::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return RentalRating::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return RentalRating::destroy($modelId);

    }

}
