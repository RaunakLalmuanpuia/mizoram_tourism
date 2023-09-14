<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\RentalRatingRepositoryInterface;

class RentalRatingControllerApi extends Controller
{
    private RentalRatingRepositoryInterface $RentalRepository;
    public function __construct(RentalRatingRepositoryInterface $RentalRepository)
    {
        $this->RentalRepository = $RentalRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->RentalRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->RentalRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->RentalRepository->getModelById($id);
    }

    public function edit(Rental $Rental) {   }

    public function update(Request $request, Rental $Rental)
    {
        return $this->RentalRepository->updateModel($Rental->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->RentalRepository->deleteModel($id);
    }
}
