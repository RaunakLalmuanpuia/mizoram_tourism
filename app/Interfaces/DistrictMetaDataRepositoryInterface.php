<?php

namespace App\Interfaces;

interface DistrictMetaDataRepositoryInterface 
{
    public function getAllDistrictMetaData();
    public function getDistrictMetaDataById($districtMetaDataId);
    public function deleteDistrictMetaData($districtMetaDataId);
    public function createDistrictMetaData(array $districtMetaDataDetails);
    public function updateDistrictMetaData($districtMetaDataId, array $newDetails);

}
