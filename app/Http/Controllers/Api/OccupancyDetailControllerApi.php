<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\OccupancyDetailRepositoryInterface;

class OccupancyDetailControllerApi extends Controller
{
    private OccupancyDetailRepositoryInterface $OccupancyDetailRepository;
    public function __construct(OccupancyDetailRepositoryInterface $OccupancyDetailRepository)
    {
        $this->OccupancyDetailRepository = $OccupancyDetailRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->OccupancyDetailRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->OccupancyDetailRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->OccupancyDetailRepository->getModelById($id);
    }

    public function edit(OccupancyDetail $OccupancyDetail) {   }

    public function update(Request $request, OccupancyDetail $OccupancyDetail)
    {
        return $this->OccupancyDetailRepository->updateModel($OccupancyDetail->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->OccupancyDetailRepository->deleteModel($id);
    }
}
