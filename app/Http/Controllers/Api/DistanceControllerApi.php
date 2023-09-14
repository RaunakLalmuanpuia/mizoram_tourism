<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\DistanceRepositoryInterface;
use App\Models\Distance;
class DistanceControllerApi extends Controller
{
    private DistanceRepositoryInterface $distanceRepository;
    public function __construct(DistanceRepositoryInterface $distanceRepository)
    {
        $this->distanceRepository = $distanceRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->distanceRepository->getAllDistance()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {   
        return [
            'data' => $this->distanceRepository->createDistance($request->all())
        ];
    }

    public function show(Distance $distance){
        return $this->distanceRepository->getDistanceById($distance->id);
    }

    public function edit(Distance $distance) {   }

    public function update(Request $request, Distance $distance)
    {
        return $this->distanceRepository->updateDistance($distance->id, $request->all());
    }

    public function destroy(Distance $distance)
    {
        return $this->distanceRepository->deleteDistance($distance->id);
    }}
