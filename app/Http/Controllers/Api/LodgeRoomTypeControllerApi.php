<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\LodgeRoomTypeRepositoryInterface;

use App\Models\LodgeRoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LodgeRoomData;
use Illuminate\Support\Facades\Log;

class LodgeRoomTypeControllerApi extends Controller
{
    private LodgeRoomTypeRepositoryInterface $lodgeRoomTypeRepository;
    public function __construct(LodgeRoomTypeRepositoryInterface $lodgeRoomTypeRepository)
    {
        $this->lodgeRoomTypeRepository = $lodgeRoomTypeRepository;
    }

    public function index()
    {  
        return [
            'data'=> $this->lodgeRoomTypeRepository->getAllLodgeRoomType()
        ];
    }

    public function create() {}

    public function store(Request $request)
    {
        return [
            'data' => $this->lodgeRoomTypeRepository->createLodgeRoomType($request->all())
        ];   
    }

    public function show($lodgeRoomTypeId)
    {
       return $this->lodgeRoomTypeRepository->getLodgeRoomTypeById($lodgeRoomTypeId);
    }


    public function edit(LodgeRoomType $lodgeRoomType){ }

    public function update(Request $request, LodgeRoomType $lodgeRoomType)
    {
        return $this->lodgeRoomTypeRepository->updateLodgeRoomType($lodgeRoomType->id, $request->all());
    }

    public function destroy(LodgeRoomType $lodgeRoomType)
    {
       return $this->lodgeRoomTypeRepository->deleteLodgeRoomType($lodgeRoomType->id);

    }
    
    public function searchAndDelete($id){
        $mRoom = LodgeRoomData::where('lodge_room_types_id',$id)->get();

        if($mRoom->count()<1){
            //IT IS ZERO AND THE ROOM TYPE IS NOT USED | CAN BE DELETED
            return LodgeRoomType::destroy($id);

        }else{
            //THE ROOM TYPE IS USED BY OTHERS, HENCE CANNOT BE DELETED;
            return false;

        }
         
    }
}
