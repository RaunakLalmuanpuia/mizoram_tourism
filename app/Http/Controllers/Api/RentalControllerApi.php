<?php

namespace App\Http\Controllers\Api;
use App\Interfaces\RentalRepositoryInterface;
use App\Models\Rental;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentalControllerApi extends Controller
{
    private RentalRepositoryInterface $rentalRepository;
    public function __construct(RentalRepositoryInterface $rentalRepository)
    {
        $this->rentalRepository = $rentalRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->rentalRepository->getAllRental()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->rentalRepository->createRental($request->all())
        ];
    }

    public function show(Rental $rental){
        return $this->rentalRepository->getRentalById($rental->id);
    }

    public function edit(Rental $rental) {   }

    public function update(Request $request, Rental $rental)
    {
        return $this->rentalRepository->updateRental($rental->id, $request->all());
    }

    public function destroy(Rental $rental)
    {
        return $this->rentalRepository->deleteRental($rental->id);
    }

    public function getRentalByDistrict($districtId){
        return $this->rentalRepository->getRentalByDistrict($districtId);
    }

    public function getAllRentalsWithRating()
    {
        $objects = Rental::with(['districtMetaData','rentalRating'])->get();
 
        foreach($objects as $key => $object){
            $ratingReceivedFromEachIndividual=array();
            $ratingPercentage=0;

            $ratings = $object->rentalRating;

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

    public function findRentalWithRating($id)
    {
        $objects = Rental::with(['districtMetaData','rentalRating'])->findOrFail($id);

        $ratingReceivedFromEachIndividual=array();
        $ratingPercentage=0;
        $ratings = $objects->rentalRating;
        
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
