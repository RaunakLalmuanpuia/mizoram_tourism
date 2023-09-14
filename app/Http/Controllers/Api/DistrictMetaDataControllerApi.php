<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\DistrictMetaDataRepositoryInterface;

use App\Models\DistrictMetaData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DistrictTopDestination;
use App\Models\Lodge;

class DistrictMetaDataControllerApi extends Controller
{
    private DistrictMetaDataRepositoryInterface $districtMetaDataRepository;
    public function __construct(DistrictMetaDataRepositoryInterface $districtMetaDataRepository)
    {
        $this->districtMetaDataRepository = $districtMetaDataRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->districtMetaDataRepository->getAllDistrictMetaData()
        ];
    }

    public function create(){}

    public function store(Request $request)
    {
       return [
            'data' => $this->districtMetaDataRepository->createDistrictMetaData($request->all())
        ];
    }

    
    public function show(DistrictMetaData $district)
    {
        return $this->districtMetaDataRepository->getDistrictMetaDataById($district->id);
    }

    public function edit(DistrictMetaData $district){}

    public function update(Request $request, DistrictMetaData $district)
    {
        return $this->districtMetaDataRepository->updateDistrictMetaData($district->id, $request->all());
    }

    public function destroy(DistrictMetaData $district)
    {
        return $this->districtMetaDataRepository->deleteDistrictMetaData($district->id);
    }

    public function imageIndex(){

    }
    public function imageUpdate(Request $request){

    }

    public function searchAndDelete($id){
        $mTopDestination = DistrictTopDestination::where('district_meta_data_id',$id)->get();
        $mLodge = Lodge::where('district_meta_data_id',$id)->get();

        if($mTopDestination->count()<1 && $mLodge->count()<1){
            //IT IS ZERO AND THE ROOM TYPE IS NOT USED | CAN BE DELETED
            return DistrictMetaData::destroy($id);

        }else{
            //THE ROOM TYPE IS USED BY OTHERS, HENCE CANNOT BE DELETED;
            return false;
        }
    }
}
