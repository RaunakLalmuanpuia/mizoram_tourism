<?php

namespace App\Http\Controllers\Api;
use App\Interfaces\GuideRepositoryInterface;
use App\Models\Guide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideControllerApi extends Controller
{

    private GuideRepositoryInterface $guideRepository;
    public function __construct(GuideRepositoryInterface $guideRepository)
    {
        $this->guideRepository = $guideRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->guideRepository->getAllGuide()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->guideRepository->createGuide($request->all())
        ];
    }

    public function show(Guide $guide){
        return $this->guideRepository->getGuideById($guide->id);
    }

    public function edit(Guide $guide) {   }

    public function update(Request $request, Guide $guide)
    {
        return $this->guideRepository->updateGuide($guide->id, $request->all());
    }

    public function destroy(Guide $guide)
    {
        return $this->guideRepository->deleteGuide($guide->id);
    }
    public function getGuideByDistrict($districtId){
        return $this->guideRepository->getGuideByDistrict($districtId);
    }

    public function getAllGuidesWithRating()
    {
        $objects = Guide::with(['districtMetaData','guideRating'])->get();
 
        foreach($objects as $key => $object){
            $ratingReceivedFromEachIndividual=array();
            $ratingPercentage=0;

            $ratings = $object->guideRating;

            foreach($ratings as $rating){
                $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
            }
            $ratingSum = array_sum($ratingReceivedFromEachIndividual);
            $ratingSize = sizeof($ratingReceivedFromEachIndividual);
            if($ratingSize==0)
                $ratingPercentage = 0;
            else
                $ratingPercentage = $ratingSum/$ratingSize; 
            $object->rating = $ratingPercentage;
        }
        return [
            'data'=> $objects
        ]; 
    }

    public function findGuideWithRating($id)
    {
        $objects = Guide::with(['districtMetaData','guideRating'])->findOrFail($id);

        $ratingReceivedFromEachIndividual=array();
        $ratingPercentage=0;
        $ratings = $objects->guideRating;
        
        foreach($ratings as $rating){
            $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
        }
        $ratingSum = array_sum($ratingReceivedFromEachIndividual);
        $ratingSize = sizeof($ratingReceivedFromEachIndividual);
        if($ratingSize==0)
            $ratingPercentage = 0;
        else
            $ratingPercentage = $ratingSum/$ratingSize;

        $objects->rating = $ratingPercentage;
         
        return [
            'data'=> $objects
        ];  
    }

}
