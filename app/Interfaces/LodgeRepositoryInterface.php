<?php

namespace App\Interfaces;

interface LodgeRepositoryInterface 
{
    public function getAllLodge();
    public function getLodgeById($lodgeId);
    public function deleteLodge($lodgeId);
    public function createLodge(array $lodgeDetails);
    public function updateLodge($lodgeId, array $newDetails);

    public function getLodgebyDistrict($districtId);

}