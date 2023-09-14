<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\InformationRepositoryInterface;
use App\Models\Information;
class InformationControllerApi extends Controller
{
    private InformationRepositoryInterface $informationRepository;
    public function __construct(InformationRepositoryInterface $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->informationRepository->getAllInformation()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->informationRepository->createInformation($request->all())
        ];
    }

    public function show(Information $information){
        return $this->informationRepository->getInformationById($information->id);
    }

    public function edit(Information $information) {   }

    public function update(Request $request, Information $information)
    {
        return $this->informationRepository->updateInformation($information->id, $request->all());
    }

    public function destroy(Information $information)
    {
        return $this->informationRepository->deleteInformation($information->id);
    }

}
