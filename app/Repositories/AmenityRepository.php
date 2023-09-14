<?php

namespace App\Repositories;

use App\Interfaces\AmenityRepositoryInterface;
use App\Models\Amenity;

class AmenityRepository implements AmenityRepositoryInterface 
{
    public function getAllAmenity(){
        return Amenity::all();
    }

      
    public function createAmenity(array $amenityDetails){
        return Amenity::create($amenityDetails);

    }
    
    public function getAmenityById($amenityId){
        return Amenity::findOrFail($amenityId);

    }
 
    public function updateAmenity($amenityId, array $newDetails){
        return Amenity::whereId($amenityId)->update($newDetails);

    }

    public function deleteAmenity($amenityId){
        return Amenity::destroy($amenityId);

    }

}
