<?php

namespace App\Repositories;

use App\Interfaces\AgentRepositoryInterface;
use App\Models\Agent;

class AgentRepository implements AgentRepositoryInterface
{
    public function getAllAgent(){
        return Agent::with(['districtMetaData'])->paginate(15);
        // return Agent::with(['districtMetaData'])->get();

    }


    public function createAgent(array $agentDetails){
        return Agent::create($agentDetails);

    }

    public function getAgentById($agentId){
         return Agent::with('districtMetaData')->findOrFail($agentId);
    }

    public function updateAgent($agentId, array $newDetails){
        return Agent::whereId($agentId)->update($newDetails);

    }

    public function deleteAgent($agentId){
        return Agent::destroy($agentId);

    }

    public function getAgentByDistrict($districtId){
        return Agent::where('district_meta_data_id',$districtId)->with('districtMetaData')->get();

    }
}
