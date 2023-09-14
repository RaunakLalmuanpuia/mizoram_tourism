<?php

namespace App\Http\Controllers\Api;
use App\Interfaces\OperatorRepositoryInterface;
use App\Models\Operator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperatorControllerApi extends Controller
{
    private OperatorRepositoryInterface $operatorRepository;
    public function __construct(OperatorRepositoryInterface $operatorRepository)
    {
        $this->operatorRepository = $operatorRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->operatorRepository->getAllOperator()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->operatorRepository->createOperator($request->all())
        ];
    }

    public function show(Operator $operator){
        return $this->operatorRepository->getOperatorById($operator->id);
    }

    public function edit(Operator $operator) {   }

    public function update(Request $request, Operator $operator)
    {
        return $this->operatorRepository->updateOperator($operator->id, $request->all());
    }

    public function destroy(Operator $operator)
    {
        return $this->operatorRepository->deleteOperator($operator->id);
    }
    public function getOperatorByDistrict($districtId){
        return $this->operatorRepository->getOperatorByDistrict($districtId);
    }

    public function getAllOperatorsWithRating()
    {
        $objects = Operator::with(['districtMetaData','operatorRating'])->get();
 
        foreach($objects as $key => $object){
            $ratingReceivedFromEachIndividual=array();
            $ratingPercentage=0;

            $ratings = $object->operatorRating;

            foreach($ratings as $rating){
                $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
            }
            $ratingSum = array_sum($ratingReceivedFromEachIndividual);
            $ratingSize = sizeof($ratingReceivedFromEachIndividual);
            if($ratingSize==0)
                $ratingPercentage = 0;
            else
                $ratingPercentage = $ratingSum/$ratingSize; 
            $object->rating = $ratingPercentage;
        }
        return [
            'data'=> $objects
        ]; 
    }

    public function findOperatorWithRating($id)
    {
        $objects = Operator::with(['districtMetaData','operatorRating'])->findOrFail($id);

        $ratingReceivedFromEachIndividual=array();
        $ratingPercentage=0;
        $ratings = $objects->operatorRating;
        
        foreach($ratings as $rating){
            $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
        }
        $ratingSum = array_sum($ratingReceivedFromEachIndividual);
        $ratingSize = sizeof($ratingReceivedFromEachIndividual);
        if($ratingSize==0)
            $ratingPercentage = 0;
        else
            $ratingPercentage = $ratingSum/$ratingSize;

        $objects->rating = $ratingPercentage;
         
        return [
            'data'=> $objects
        ];   
    }
}
