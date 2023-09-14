<?php

namespace App\Repositories;

use App\Interfaces\RestaurantRatingRepositoryInterface;
use App\Models\RestaurantRating;

class RestaurantRatingRepository implements RestaurantRatingRepositoryInterface 
{
    public function getAllModel(){
        return RestaurantRating::all();
    }

      
    public function createModel(array $modelDetails){
        return RestaurantRating::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return RestaurantRating::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return RestaurantRating::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return RestaurantRating::destroy($modelId);

    }

}
