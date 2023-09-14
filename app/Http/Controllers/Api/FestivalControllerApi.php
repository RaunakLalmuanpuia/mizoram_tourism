<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\FestivalRepositoryInterface;
use App\Models\Festival;
class FestivalControllerApi extends Controller
{
    private FestivalRepositoryInterface $festivalRepository;
    public function __construct(FestivalRepositoryInterface $festivalRepository)
    {
        $this->festivalRepository = $festivalRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->festivalRepository->getAllFestival()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->festivalRepository->createFestival($request->all())
        ];
    }

    public function show(Festival $festival){
        return $this->festivalRepository->getFestivalById($festival->id);
    }

    public function edit(Festival $festival) {   }

    public function update(Request $request, Festival $festival)
    {
        return $this->festivalRepository->updateFestival($festival->id, $request->all());
    }

    public function destroy(Festival $festival)
    {
        return $this->festivalRepository->deleteFestival($festival->id);
    }}
