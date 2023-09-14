<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\GuideRatingRepositoryInterface;

class GuideRatingControllerApi extends Controller
{
    private GuideRatingRepositoryInterface $GuideRepository;
    public function __construct(GuideRatingRepositoryInterface $GuideRepository)
    {
        $this->GuideRepository = $GuideRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->GuideRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->GuideRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->GuideRepository->getModelById($id);
    }

    public function edit(Guide $Guide) {   }

    public function update(Request $request, Guide $Guide)
    {
        return $this->GuideRepository->updateModel($Guide->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->GuideRepository->deleteModel($id);
    }
}
