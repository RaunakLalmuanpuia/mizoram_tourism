<?php

namespace App\Interfaces;

interface FestivalRepositoryInterface 
{
    public function getAllFestival();
    public function getFestivalById($festivalId);
    public function deleteFestival($festivalId);
    public function createFestival(array $festivalDetails);
    public function updateFestival($festivalId, array $newDetails);

}