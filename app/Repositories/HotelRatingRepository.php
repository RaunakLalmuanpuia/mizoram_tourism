<?php

namespace App\Repositories;

use App\Interfaces\HotelRatingRepositoryInterface;
use App\Models\HotelRating;

class HotelRatingRepository implements HotelRatingRepositoryInterface 
{
    public function getAllModel(){
        return HotelRating::all();
    }

    public function createModel(array $modelDetails){
        return HotelRating::create($modelDetails);

    }
    
    public function getModelById($modelId){
        return HotelRating::findOrFail($modelId);

    }
 
    public function updateModel($modelId, array $newDetails){
        return HotelRating::whereId($modelId)->update($newDetails);

    }

    public function deleteModel($modelId){
        return HotelRating::destroy($modelId);

    }

}
