<?php

namespace App\Interfaces;

interface DistrictTopDestinationRepositoryInterface 
{
    public function getAllDistrictTopDestination();
    public function getDistrictTopDestinationById($districtTopDestinationId);
    public function deleteDistrictTopDestination($districtTopDestinationId);
    public function createDistrictTopDestination(array $districtTopDestinationDetails);
    public function updateDistrictTopDestination($districtTopDestinationId, array $newDetails);

    public function getTopDestinationByDistrictId($districtId);
    public function getRandomDestination($count);
}                   
