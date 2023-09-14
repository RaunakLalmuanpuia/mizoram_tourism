<?php

namespace App\Repositories;

use App\Interfaces\RestaurantRepositoryInterface;
use App\Models\Restaurant;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getAllRestaurant(){
        // return Restaurant::with('districtMetaData')->get();
        return Restaurant::with('districtMetaData')->paginate(15);
    }


    public function createRestaurant(array $restaurantDetails){
        return Restaurant::create($restaurantDetails);

    }

    public function getRestaurantById($restaurantId){
        return Restaurant::with('districtMetaData')->findOrFail($restaurantId);

    }

    public function updateRestaurant($restaurantId, array $newDetails){
        return Restaurant::whereId($restaurantId)->update($newDetails);

    }

    public function deleteRestaurant($restaurantId){
        return Restaurant::destroy($restaurantId);

    }

    public function getRestaurantByDistrict($districtId){
        return Restaurant::where('district_meta_data_id',$districtId)->with('districtMetaData')->get();

    }


}
