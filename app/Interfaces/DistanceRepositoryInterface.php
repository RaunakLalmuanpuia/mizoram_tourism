<?php

namespace App\Interfaces;

interface DistanceRepositoryInterface 
{
    public function getAllDistance();
    public function getDistanceById($distanceId);
    public function deleteDistance($distanceId);
    public function createDistance(array $distanceIdDetails);
    public function updateDistance($distanceIdId, array $newDetails);

}