<?php

namespace App\Interfaces;

interface GuideRepositoryInterface 
{
    public function getAllGuide();
    public function getGuideById($guideId);
    public function deleteGuide($guideId);
    public function createGuide(array $guideDetails);
    public function updateGuide($guideId, array $newDetails);
    public function getGuideByDistrict($districtId);

}