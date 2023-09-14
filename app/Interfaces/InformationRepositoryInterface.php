<?php

namespace App\Interfaces;

interface InformationRepositoryInterface 
{
    public function getAllInformation();
    public function getInformationById($informationId);
    public function deleteInformation($informationId);
    public function createInformation(array $informationDetails);
    public function updateInformation($informationId, array $newDetails);

}