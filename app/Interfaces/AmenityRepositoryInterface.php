<?php

namespace App\Interfaces;

interface AmenityRepositoryInterface 
{
    public function getAllAmenity();
    public function getAmenityById($amenityId);
    public function deleteAmenity($amenityId);
    public function createAmenity(array $amenityDetails);
    public function updateAmenity($amenityId, array $newDetails);

}