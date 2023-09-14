<?php

namespace App\Interfaces;

interface LodgeRoomDataRepositoryInterface 
{
    public function getAllLodgeRoomData();
    public function getLodgeRoomDataById($lodgeRoomDataId);
    public function deleteLodgeRoomData($lodgeRoomDataId);
    public function createLodgeRoomData(array $lodgeRoomDataDetails);
    public function updateLodgeRoomData($lodgeRoomDataId, array $newDetails);

    public function getTypebyLodge($lodgeId);
    public function getRoomAvailablePrice($roomId);
    
    public function getRoomsByLodgeId($lodgeId);
}