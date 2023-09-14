<?php

namespace App\Interfaces;

interface HotelRepositoryInterface 
{
    public function getAllHotel();
    public function getHotelById($hotelId);
    public function deleteHotel($hotelId);
    public function createHotel(array $hotelDetails);
    public function updateHotel($hotelId, array $newDetails);
    public function getHotelByDistrict($districtId);

}