<?php

namespace App\Interfaces;

interface AboutRepositoryInterface 
{
    public function getAllAbout();
    public function getAboutById($aboutId);
    public function deleteAbout($aboutId);
    public function createAbout(array $aboutDetails);
    public function updateAbout($aboutId, array $newDetails);

}