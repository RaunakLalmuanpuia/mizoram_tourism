<?php

namespace App\Http\Controllers\Api;
use App\Interfaces\RestaurantRepositoryInterface;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantControllerApi extends Controller
{
    private RestaurantRepositoryInterface $restaurantRepository;
    public function __construct(RestaurantRepositoryInterface $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->restaurantRepository->getAllRestaurant()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->restaurantRepository->createRestaurant($request->all())
        ];
    }

    public function show(Restaurant $restaurant){
        return $this->restaurantRepository->getRestaurantById($restaurant->id);
    }

    public function edit(Restaurant $restaurant) {   }

    public function update(Request $request, Restaurant $restaurant)
    {
        return $this->restaurantRepository->updateRestaurant($restaurant->id, $request->all());
    }

    public function destroy(Restaurant $restaurant)
    {
        return $this->restaurantRepository->deleteRestaurant($restaurant->id);
    }
    public function getRestaurantByDistrict($districtId){
        return $this->restaurantRepository->getRestaurantByDistrict($districtId);
    }

    public function getAllRestaurantsWithRating()
    {
        $objects = Restaurant::with(['districtMetaData','restaurantRating'])->get();
 
        foreach($objects as $key => $object){
            $ratingReceivedFromEachIndividual=array();
            $ratingPercentage=0;

            $ratings = $object->restaurantRating;

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

    public function findRestaurantWithRating($id)
    {
        $objects = Restaurant::with(['districtMetaData','restaurantRating'])->findOrFail($id);

        $ratingReceivedFromEachIndividual=array();
        $ratingPercentage=0;
        $ratings = $objects->restaurantRating;
        
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
