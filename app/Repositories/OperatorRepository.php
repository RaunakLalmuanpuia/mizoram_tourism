<?php

namespace App\Repositories;

use App\Interfaces\OperatorRepositoryInterface;
use App\Models\Operator;

class OperatorRepository implements OperatorRepositoryInterface 
{
    public function getAllOperator(){
        return Operator::with('districtMetaData')->get();
    }

      
    public function createOperator(array $operatorDetails){
        return Operator::create($operatorDetails);

    }
    
    public function getOperatorById($operatorId){
        return Operator::with('districtMetaData')->findOrFail($operatorId);

    }
 
    public function updateOperator($operatorId, array $newDetails){
        return Operator::whereId($operatorId)->update($newDetails);

    }

    public function deleteOperator($operatorId){
        return Operator::destroy($operatorId);

    }
    public function getOperatorByDistrict($districtId){
        return Operator::where('district_meta_data_id',$districtId)->with('districtMetaData')->get();

    }
}
