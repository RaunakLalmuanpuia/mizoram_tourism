<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\HotelRepositoryInterface;
use App\Models\Hotel;
use App\Http\Controllers\Controller;
use App\Models\DistrictMetaData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelControllerApi extends Controller
{
  private HotelRepositoryInterface $hotelRepository;
  public function __construct(HotelRepositoryInterface $hotelRepository)
  {
    $this->hotelRepository = $hotelRepository;
  }

  public function index()
  {

    return [
      'data' => $this->hotelRepository->getAllHotel()
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    return [
      'data' => $this->hotelRepository->createHotel($request->all())
    ];
  }

  public function show(Hotel $hotel)
  {
    return $this->hotelRepository->getHotelById($hotel->id);
  }

  public function edit(Hotel $hotel)
  {
  }

  public function update(Request $request, Hotel $hotel)
  {
    return $this->hotelRepository->updateHotel($hotel->id, $request->all());
  }

  public function destroy(Hotel $hotel)
  {
    return $this->hotelRepository->deleteHotel($hotel->id);
  }

  public function getDistrictWiseHotels()
  {
    $districts = DistrictMetaData::with(['hotel', 'restaurant', 'operator', 'rental', 'agent', 'guide'])->get();
    return $districts;
  }

  public function getAllHotelsWithRating()
  {

    $data = DistrictMetaData::with(['hotel' => function ($d) {
      $d->with('hotelRating');
    }])->get();

    foreach ($data as $key => $object) {
      $ratingReceivedFromEachIndividual = array();
      $ratingPercentage = 0;
      $hotels = $object->hotel;

      foreach ($hotels as $ra) {
        $ratings = $ra->hotelRating;
        foreach ($ratings as $rating) {
          $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
        }
        $ratingSum = array_sum($ratingReceivedFromEachIndividual);
        $ratingSize = sizeof($ratingReceivedFromEachIndividual);
        if ($ratingSize == 0)
          $ratingPercentage = 0;
        else
          $ratingPercentage = $ratingSum / $ratingSize;
        $ra->rating = $ratingPercentage;
      }
    }
    return [
      'data' => $data
    ];
  }

  public function findHotelWithRating($id)
  {
    $objects = Hotel::with(['districtMetaData', 'hotelRating'])->findOrFail($id);

    $ratingReceivedFromEachIndividual = array();
    $ratingPercentage = 0;
    $ratings = $objects->hotelRating;

    foreach ($ratings as $rating) {
      $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
    }
    $ratingSum = array_sum($ratingReceivedFromEachIndividual);
    $ratingSize = sizeof($ratingReceivedFromEachIndividual);
    if ($ratingSize == 0)
      $ratingPercentage = 0;
    else
      $ratingPercentage = $ratingSum / $ratingSize;

    $objects->rating = $ratingPercentage;

    return [
      'data' => $objects
    ];
  }
}
