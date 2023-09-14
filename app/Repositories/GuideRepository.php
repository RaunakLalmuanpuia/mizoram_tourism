<?php

namespace App\Repositories;

use App\Interfaces\GuideRepositoryInterface;
use App\Models\Guide;

class GuideRepository implements GuideRepositoryInterface
{
    public function getAllGuide(){
        return Guide::with('districtMetaData')->paginate(10);
    }


    public function createGuide(array $guideDetails){
        return Guide::create($guideDetails);

    }

    public function getGuideById($guideId){
        return Guide::with('districtMetaData')->findOrFail($guideId);
    }

    public function updateGuide($guideId, array $newDetails){
        return Guide::whereId($guideId)->update($newDetails);

    }

    public function deleteGuide($guideId){
        return Guide::destroy($guideId);

    }

    public function getGuideByDistrict($districtId){
        return Guide::where('district_meta_data_id',$districtId)->with('districtMetaData')->get();

    }
}
