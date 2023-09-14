<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\AmenityRepositoryInterface;
use App\Models\Amenity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmenityControllerApi extends Controller
{

    private AmenityRepositoryInterface $amenityRepository;
    public function __construct(AmenityRepositoryInterface $amenityRepository)
    {
        $this->amenityRepository = $amenityRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->amenityRepository->getAllAmenity()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->amenityRepository->createAmenity($request->all())
        ];
    }

    public function show(Amenity $amenity){
        return $this->amenityRepository->getAmenityById($amenity->id);
    }

    public function edit(Amenity $amenity) {   }

    public function update(Request $request, Amenity $amenity)
    {
        return $this->amenityRepository->updateAmenity($amenity->id, $request->all());
    }

    public function destroy(Amenity $amenity)
    {
        return $this->amenityRepository->deleteAmenity($amenity->id);
    }
}
