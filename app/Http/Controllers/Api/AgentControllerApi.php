<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\AgentRepositoryInterface;
use App\Models\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Support\Facades\Log;
use League\CommonMark\Extension\CommonMark\Parser\Inline\OpenBracketParser;
use function GuzzleHttp\json_encode;

class AgentControllerApi extends Controller
{
  private AgentRepositoryInterface $agentRepository;

  public function __construct(AgentRepositoryInterface $agentRepository)
  {
    $this->agentRepository = $agentRepository;
  }

  public function index()
  {
    return [
      'data' => $this->agentRepository->getAllAgent()
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    return [
      'data' => $this->agentRepository->createAgent($request->all())
    ];
  }

  public function show(Agent $agent)
  {
    return $this->agentRepository->getAgentById($agent->id);
  }

  public function edit(Agent $Agent)
  {
  }

  public function update(Request $request, Agent $agent)
  {
    return $this->agentRepository->updateAgent($agent->id, $request->all());
  }

  public function destroy(Agent $agent)
  {
    return $this->agentRepository->deleteAgent($agent->id);
  }

  public function getAgentByDistrict($districtId)
  {
    return $this->agentRepository->getAgentByDistrict($districtId);
  }

  public function getAllAgentsWithRating()
  {
    $agents = Agent::with(['districtMetaData', 'agentRating'])->get();

    foreach ($agents as $key => $agent) {
      $ratingReceivedFromEachIndividual = array();
      $ratingPercentage = 0;

      $ratings = $agent->agentRating;

      foreach ($ratings as $rating) {
        $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
      }
      $ratingSum = array_sum($ratingReceivedFromEachIndividual);
      $ratingSize = sizeof($ratingReceivedFromEachIndividual);
      if ($ratingSize == 0)
        $ratingPercentage = 0;
      else
        $ratingPercentage = $ratingSum / $ratingSize;
      $agent->rating = $ratingPercentage;
    }
    return [
      'data' => $agents
    ];
  }

  public function findAgentWithRating($id)
  {
    $agents = Agent::with(['districtMetaData', 'agentRating'])->findOrFail($id);

    $ratingReceivedFromEachIndividual = array();
    $ratingPercentage = 0;
    $ratings = $agents->agentRating;

    foreach ($ratings as $rating) {
      $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
    }
    $ratingSum = array_sum($ratingReceivedFromEachIndividual);
    $ratingSize = sizeof($ratingReceivedFromEachIndividual);
    if ($ratingSize == 0)
      $ratingPercentage = 0;
    else
      $ratingPercentage = $ratingSum / $ratingSize;
    $agents->rating = $ratingPercentage;

    return [
      'data' => $agents
    ];
  }
}
