<?php

namespace App\Repositories;

use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;

class HotelRepository implements HotelRepositoryInterface
{
    public function getAllHotel(){
        return Hotel::with('districtMetaData')->paginate(10);
    }


    public function createHotel(array $hotelDetails){
        return Hotel::create($hotelDetails);

    }

    public function getHotelById($hotelId){
        return Hotel::with('districtMetaData')->findOrFail($hotelId);

    }

    public function updateHotel($hotelId, array $newDetails){
        return Hotel::whereId($hotelId)->update($newDetails);

    }

    public function deleteHotel($hotelId){
        return Hotel::destroy($hotelId);

    }

    public function getHotelByDistrict($districtId){
        return Hotel::where('district_meta_data_id',$districtId)->with('districtMetaData')->get();

    }
}
