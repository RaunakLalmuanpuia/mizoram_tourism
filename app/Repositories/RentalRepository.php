<?php

namespace App\Repositories;

use App\Interfaces\RentalRepositoryInterface;
use App\Models\Rental;

class RentalRepository implements RentalRepositoryInterface 
{
    public function getAllRental(){
        return Rental::with('districtMetaData')->get();
    }

      
    public function createRental(array $rentalDetails){
        return Rental::create($rentalDetails);

    }
    
    public function getRentalById($rentalId){
        return Rental::with('districtMetaData')->findOrFail($rentalId);

    }
 
    public function updateRental($rentalId, array $newDetails){
        return Rental::whereId($rentalId)->update($newDetails);

    }

    public function deleteRental($rentalId){
        return Rental::destroy($rentalId);

    }
    public function getRentalByDistrict($districtId){
        return Rental::where('district_meta_data_id',$districtId)->with('districtMetaData')->get();

    }
}
