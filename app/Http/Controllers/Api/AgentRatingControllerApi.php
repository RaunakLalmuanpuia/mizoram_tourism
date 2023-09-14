<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\AgentRatingRepositoryInterface;
use App\Models\AgentRating;

class AgentRatingControllerApi extends Controller
{
    private AgentRatingRepositoryInterface $AgentRepository;
    public function __construct(AgentRatingRepositoryInterface $AgentRepository)
    {
        $this->AgentRepository = $AgentRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->AgentRepository->getAllModel()
        ];  
    }

    public function create() {  }

    public function store(Request $request)
    {
        return [
            'data' => $this->AgentRepository->createModel($request->all())
        ];
    }

    public function show($id){
        return $this->AgentRepository->getModelById($id);
    }

    public function edit(Agent $Agent) {   }

    public function update(Request $request, Agent $Agent)
    {
        return $this->AgentRepository->updateModel($Agent->id, $request->all());
    }

    public function destroy($id)
    {
        return $this->AgentRepository->deleteModel($id);
    }


}
