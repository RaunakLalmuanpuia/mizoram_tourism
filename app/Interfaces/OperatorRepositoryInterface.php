<?php

namespace App\Interfaces;

interface OperatorRepositoryInterface 
{
    public function getAllOperator();
    public function getOperatorById($operatorId);
    public function deleteOperator($operatorId);
    public function createOperator(array $operatorDetails);
    public function updateOperator($operatorId, array $newDetails);
    public function getOperatorByDistrict($districtId);

}