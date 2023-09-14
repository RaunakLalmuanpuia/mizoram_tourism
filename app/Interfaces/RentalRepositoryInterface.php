<?php

namespace App\Interfaces;

interface RentalRepositoryInterface 
{
    public function getAllRental();
    public function getRentalById($rentalId);
    public function deleteRental($rentalId);
    public function createRental(array $rentalDetails);
    public function updateRental($rentalId, array $newDetails);
    public function getRentalByDistrict($districtId);

}