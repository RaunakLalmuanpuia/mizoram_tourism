<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\LodgeRatingRepositoryInterface;

class LodgeRatingControllerApi extends Controller
{
    private LodgeRatingRepositoryInterface $LodgeRepository;
    public function __construct(LodgeRatingRepositoryInterface $LodgeRepository)
    {
        $this->LodgeRepository = $LodgeRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->LodgeRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->LodgeRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->LodgeRepository->getModelById($id);
    }

    public function edit(Lodge $Lodge) {   }

    public function update(Request $request, Lodge $Lodge)
    {
        return $this->LodgeRepository->updateModel($Lodge->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->LodgeRepository->deleteModel($id);
    }
}
