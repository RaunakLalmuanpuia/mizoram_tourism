<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\IndexRepositoryInterface;
use App\Models\Index;
class IndexControllerApi extends Controller
{
    private IndexRepositoryInterface $IndexRepository;
    public function __construct(IndexRepositoryInterface $IndexRepository)
    {
        $this->IndexRepository = $IndexRepository;
    }

    public function index()
    {

        return [
            'data'=> $this->IndexRepository->getAllIndex()
        ];  
  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->IndexRepository->createIndex($request->all())
        ];
    }

    public function show($id){
        return $this->IndexRepository->getIndexById($id);
    }

    public function edit(Index $Index) {   }

    public function update(Request $request, Index $Index)
    {
        return $this->IndexRepository->updateIndex($Index->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->IndexRepository->deleteIndex($id);
    }

    public function getResidenceByCategory($category){
        /*
        Category Local = Local
        Category Domestic = Domestic
        Category Others = NRI and Foreign
        */
        $cat = '';
        switch($category){
            case "Local":$cat = "Local";break;
            case "Domestic":$cat = "Domestic";break;
            case "NRI":$cat = "Others";break;
            case "Foreign":$cat = "Others";break;

        }

        return Index::orderBy('name')->where('category',$cat)->get();

     }
}
