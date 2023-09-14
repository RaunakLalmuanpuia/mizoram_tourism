<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CarousalRepositoryInterface;
use App\Models\Carousal;
use Illuminate\Support\Facades\Log;

class CarousalControllerApi extends Controller
{

    private CarousalRepositoryInterface $CarousalRepository;
    public function __construct(CarousalRepositoryInterface $CarousalRepository)
    {
        $this->CarousalRepository = $CarousalRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->CarousalRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->CarousalRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->CarousalRepository->getModelById($id);
    }

    public function edit(Carousal $Carousal) {   }

    public function update(Request $request, $id)
    {
        return $this->CarousalRepository->updateModel($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->CarousalRepository->deleteModel($id);
    }
    
    public function changeStatus($id){
        $carousal = Carousal::find($id);
        $carousal->status=!$carousal->status;
        $carousal->save();
        return[
            'data'=> $this->CarousalRepository->getAllModel()
        ];

    }

    public function countTheStatus(){

        $statusCount = Carousal::where("status",true)->count();
        return $statusCount;
        // if($statusCount>5)
        //     return false;
        // else 
        //     return true;
         

    }

    public function getTheFiveEnabled(){
        $carousals = Carousal::with('images')->where("status",true)->get();
        $mCollection =  \collect([]);
        foreach($carousals as $carousal){
            if(sizeof($carousal->images)){
                //IMAGE PRESENT
                $mCollection->push($carousal['images'][0]);    

            }else{
                //IMAGE ABSENT
            }
        }

        return [
            'data'=>$mCollection
        ];
    }
    
}
