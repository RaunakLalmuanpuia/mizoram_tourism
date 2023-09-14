<?php

namespace App\Interfaces;

interface MizoramRepositoryInterface 
{
    public function getAllMizoram();
    public function getMizoramById($MizoramId);
    public function deleteMizoram($MizoramId);
    public function createMizoram(array $MizoramDetails);
    public function updateMizoram($MizoramId, array $newDetails);

}