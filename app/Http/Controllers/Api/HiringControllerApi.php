<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\HiringRepositoryInterface;
use App\Models\Hiring;

class HiringControllerApi extends Controller
{
    
    private HiringRepositoryInterface $HiringRepository;
    public function __construct(HiringRepositoryInterface $HiringRepository)
    {
        $this->HiringRepository = $HiringRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->HiringRepository->getAllHiring()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->HiringRepository->createHiring($request->all())
        ];
    }

    public function show($Hiring){
        return $this->HiringRepository->getHiringById($Hiring);
    }

    public function edit(Hiring $Hiring) {   }

    public function update(Request $request,  $Hiring)
    {
        return $this->HiringRepository->updateHiring($Hiring, $request->all());
    }

    public function destroy($Hiring)
    {
        return $this->HiringRepository->deleteHiring($Hiring);
    }
}
