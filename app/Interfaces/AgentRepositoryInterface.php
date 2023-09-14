<?php

namespace App\Interfaces;

interface AgentRepositoryInterface 
{
    public function getAllAgent();
    public function getAgentById($agentId);
    public function deleteAgent($agentId);
    public function createAgent(array $agentDetails);
    public function updateAgent($agentId, array $newDetails);
    public function getAgentByDistrict($districtId);

}