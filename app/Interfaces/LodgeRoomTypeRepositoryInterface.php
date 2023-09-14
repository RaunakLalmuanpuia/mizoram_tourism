<?php

namespace App\Interfaces;

interface LodgeRoomTypeRepositoryInterface 
{
    public function getAllLodgeRoomType();
    public function getLodgeRoomTypeById($lodgeRoomTypeId);
    public function deleteLodgeRoomType($lodgeRoomTypeId);
    public function createLodgeRoomType(array $lodgeRoomTypeDetails);
    public function updateLodgeRoomType($lodgeRoomTypeId, array $newDetails);

}