<?php

namespace App\Repositories;

use App\Interfaces\GuideRatingRepositoryInterface;
use App\Models\GuideRating;

class GuideRatingRepository implements GuideRatingRepositoryInterface 
{
    public function getAllModel(){
        return GuideRating::all();
    }

      
    public function createModel(array $modelDetails){
        return GuideRating::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return GuideRating::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return GuideRating::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return GuideRating::destroy($modelId);

    }

}
