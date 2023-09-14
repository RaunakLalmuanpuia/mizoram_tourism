<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\HotelRatingRepositoryInterface;

class HotelRatingControllerApi extends Controller
{
    private HotelRatingRepositoryInterface $HotelRepository;
    public function __construct(HotelRatingRepositoryInterface $HotelRepository)
    {
        $this->HotelRepository = $HotelRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->HotelRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->HotelRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->HotelRepository->getModelById($id);
    }

    public function edit(Hotel $Hotel) {   }

    public function update(Request $request, Hotel $Hotel)
    {
        return $this->HotelRepository->updateModel($Hotel->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->HotelRepository->deleteModel($id);
    }

}
