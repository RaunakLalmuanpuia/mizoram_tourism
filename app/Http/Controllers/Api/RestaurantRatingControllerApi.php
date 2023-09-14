<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\RestaurantRatingRepositoryInterface;

class RestaurantRatingControllerApi extends Controller
{
    private RestaurantRatingRepositoryInterface $RestaurantRepository;
    public function __construct(RestaurantRatingRepositoryInterface $RestaurantRepository)
    {
        $this->RestaurantRepository = $RestaurantRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->RestaurantRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->RestaurantRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->RestaurantRepository->getModelById($id);
    }

    public function edit(Restaurant $Restaurant) {   }

    public function update(Request $request, Restaurant $Restaurant)
    {
        return $this->RestaurantRepository->updateModel($Restaurant->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->RestaurantRepository->deleteModel($id);
    }

}
