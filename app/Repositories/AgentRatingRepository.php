<?php

namespace App\Repositories;

use App\Interfaces\AgentRatingRepositoryInterface;
use App\Models\AgentRating;

class AgentRatingRepository implements AgentRatingRepositoryInterface 
{
    public function getAllModel(){
        return AgentRating::with('agents')->get();
    }

      
    public function createModel(array $modelDetails){
        return AgentRating::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return AgentRating::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return AgentRating::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return AgentRating::destroy($modelId);

    }

}
