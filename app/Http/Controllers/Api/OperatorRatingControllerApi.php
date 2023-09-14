<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\OperatorRatingRepositoryInterface;

class OperatorRatingControllerApi extends Controller
{
    private OperatorRatingRepositoryInterface $OperatorRepository;
    public function __construct(OperatorRatingRepositoryInterface $OperatorRepository)
    {
        $this->OperatorRepository = $OperatorRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->OperatorRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->OperatorRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->OperatorRepository->getModelById($id);
    }

    public function edit(Operator $Operator) {   }

    public function update(Request $request, Operator $Operator)
    {
        return $this->OperatorRepository->updateModel($Operator->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->OperatorRepository->deleteModel($id);
    }

}
