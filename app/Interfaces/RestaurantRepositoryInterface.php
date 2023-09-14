<?php

namespace App\Interfaces;

interface RestaurantRepositoryInterface 
{
    public function getAllRestaurant();
    public function getRestaurantById($restaurantId);
    public function deleteRestaurant($restaurantId);
    public function createRestaurant(array $restaurantDetails);
    public function updateRestaurant($restaurantId, array $newDetails);
    public function getRestaurantByDistrict($districtId);

}