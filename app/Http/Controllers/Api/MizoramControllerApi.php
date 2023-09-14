<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\MizoramRepositoryInterface;
use App\Models\Mizoram;
class MizoramControllerApi extends Controller
{

    private MizoramRepositoryInterface $MizoramRepository;
    public function __construct(MizoramRepositoryInterface $MizoramRepository)
    {
        $this->MizoramRepository = $MizoramRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->MizoramRepository->getAllMizoram()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->MizoramRepository->createMizoram($request->all())
        ];
    }

    public function show(Mizoram $Mizoram){
        return $this->MizoramRepository->getMizoramById($Mizoram->id);
    }

    public function edit(Mizoram $Mizoram) {   }

    public function update(Request $request, Mizoram $Mizoram)
    {
        return $this->MizoramRepository->updateMizoram($Mizoram->id, $request->all());
    }

    public function destroy(Mizoram $Mizoram)
    {
        return $this->MizoramRepository->deleteMizoram($Mizoram->id);
    }
}
