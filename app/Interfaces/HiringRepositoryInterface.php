<?php

namespace App\Interfaces;

interface HiringRepositoryInterface 
{
    public function getAllHiring();
    public function getHiringById($hiringId);
    public function deleteHiring($hiringId);
    public function createHiring(array $hiringDetails);
    public function updateHiring($hiringId, array $newDetails);

}