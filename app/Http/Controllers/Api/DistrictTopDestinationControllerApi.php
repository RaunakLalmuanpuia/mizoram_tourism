<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\DistrictTopDestinationRepositoryInterface;

use App\Models\DistrictTopDestination;
use App\Models\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class DistrictTopDestinationControllerApi extends Controller
{

  private DistrictTopDestinationRepositoryInterface $districtTopDestinationRepository;
  public function __construct(DistrictTopDestinationRepositoryInterface $districtTopDestinationRepository)
  {
    $this->districtTopDestinationRepository = $districtTopDestinationRepository;
  }

  public function index()
  {
    return [
      'data' => $this->districtTopDestinationRepository->getAllDistrictTopDestination()
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    
    
    return [
      'data' => $this->districtTopDestinationRepository->createDistrictTopDestination($request->all())
    ];
  }

  public function show(DistrictTopDestination $destination)
  {
    return $this->districtTopDestinationRepository->getDistrictTopDestinationById($destination->id);
  }

  public function edit(DistrictTopDestination $destination)
  {
  }

  public function update(Request $request, DistrictTopDestination $destination)
  {
    return $this->districtTopDestinationRepository->updateDistrictTopDestination($destination->id, $request->all());
  }

  public function destroy(DistrictTopDestination $destination)
  {
    return $this->districtTopDestinationRepository->deleteDistrictTopDestination($destination->id);
  }

  public function getTopDestinationByDistrictId($districtId)
  {
    return $this->districtTopDestinationRepository->getTopDestinationByDistrictId($districtId);
  }

  public function getAllTagByDestination($id)
  {
    $destination = DistrictTopDestination::find($id);
    $tags = $destination->tags;
    return $tags;
  }

  public function getAllDestinationByTag($id)
  {
    $tag = Tag::find($id);
    $destinations = $tag->districtTopDestinations;
    return $destinations;
  }

  public function getAllTags()
  {
    $tag = Tag::get();
    return $tag;
  }

  public function getRandomDestination($count){
    return $this->districtTopDestinationRepository->getRandomDestination($count);
  }
  public function getAllImageTopDestination($topDestinationId)
  {
    return DistrictTopDestination::where('id',$topDestinationId)->with(['images'])->get();
  }
}
