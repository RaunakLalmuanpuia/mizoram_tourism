<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\LodgeRepositoryInterface;

use App\Models\Lodge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LodgeRoomData;
use App\Models\LodgeRoomType;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\UserLodge;
use Illuminate\Support\Collection;

class LodgeControllerApi extends Controller
{
  private LodgeRepositoryInterface $lodgeRepository;
  public function __construct(LodgeRepositoryInterface $lodgeRepository)
  {
    $this->lodgeRepository = $lodgeRepository;
  }

  public function index()
  {
    $roomTypes = LodgeRoomType::pluck('id');
    $rooms = LodgeRoomData::whereIn('lodge_room_types_id', $roomTypes)->pluck('lodges_id');

    $lodges = Lodge::whereIn('id', $rooms)->with('images', 'districtMetaData', 'amenities')->orderBy('name', 'asc')->get() ?? [];
    // $data=Lodge::with('images','districtMetaData','amenities')->get();
    return [
      //'data'=> $this->lodgeRepository->getAllLodge()
      'data' => $lodges
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    return [
      'data' => $this->lodgeRepository->createLodge($request->all())
    ];
  }

  public function show(Lodge $Lodge)
  {
    return $this->lodgeRepository->getLodgeById($Lodge->id);
  }

  public function edit(Lodge $lodge)
  {
  }

  public function update(Request $request, Lodge $lodge)
  {
    return $this->lodgeRepository->updateLodge($lodge->id, $request->all());
  }

  public function destroy(Lodge $lodge)
  {
    return $this->lodgeRepository->deleteLodge($lodge->id);
  }

  public function getByDistrict($districtId)
  {
    return $this->lodgeRepository->getLodgebyDistrict($districtId);
  }

  public function filterLodges(Request $request)
  {
    $id = $request->id != null ? $request->id : [];
    $data = Lodge::whereIn('district_meta_data_id', $id)->get();
    return ['data' => $data];
  }

  public function getAllLodgesWithRating()
  {
    $objects = Lodge::with(['districtMetaData', 'lodgeRating', 'images', 'amenities'])->get();

    foreach ($objects as $key => $object) {
      $ratingReceivedFromEachIndividual = array();
      $ratingPercentage = 0;

      $ratings = $object->lodgeRating;

      foreach ($ratings as $rating) {
        $ratingReceivedFromEachIndividual[] = (int)$rating->vote;
      }
      $ratingSum = array_sum($ratingReceivedFromEachIndividual);
      $ratingSize = sizeof($ratingReceivedFromEachIndividual);
      if ($ratingSize == 0)
        $ratingPercentage = 0;
      else
        $ratingPercentage = $ratingSum / $ratingSize;
      $object->rating = $ratingPercentage;
    }
    return [
      'data' => $objects
    ];
  }

  public function findLodgeWithRating($id)
  {
    $objects = Lodge::with(['districtMetaData', 'lodgeRating'])->findOrFail($id);

    $ratingReceivedFromEachIndividual = array();
    $ratingPercentage = 0;
    $ratings = $objects->lodgeRating;

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

  public function getLodgeAccordingToRole($id)
  {
    $user = User::find($id);


    if ($user['role'] == 'admin') {
      return [
        'data' => Lodge::with(['districtMetaData', 'amenities'])->orderBy('district_meta_data_id')->get()
      ];
    } else {
      //$lodge= User::with(['lodges','districtMetaData', 'amenities'])->find($user['id']);

      $lodges_id = UserLodge::where('users_id', $user['id'])->pluck('lodges_id')->toArray();
      $c = collect();
      foreach ($lodges_id as $id) {
        $lodge = Lodge::with(['districtMetaData', 'amenities'])->find($id);
        if ($lodge != null) {
          $c->push($lodge);
        }
      }
      return [
        'data' => $c
      ];
    }
  }

  public function userHasLodge($id)
  {
    if (UserLodge::where('users_id', $id)->exists()) {
      return [
        'data' => true
      ];
    } else {
      return [
        'data' => false
      ];
    }
  }

  public function getOnlyLodgeName()
  {
    return [
      'data' => Lodge::orderBy('name')->get()
    ];
  }

  public function getSingleLodgeName($id)
  {
    return [
      'data' => Lodge::where('id', $id)->get()
    ];
    // return Lodge::where('id',$id)->pluck('name')->first()   ;
  }

  public function findLodgeWithUser($id)
  {
    $user = User::with('lodges')->find($id);

    return $user->lodges;
  }

  public function searchAndDelete($id)
  {
    $mLodge = LodgeRoomData::where('lodges_id', $id)->get();
    if ($mLodge->count() < 1) {
      //IT IS ZERO AND THE ROOM TYPE IS NOT USED | CAN BE DELETED

      UserLodge::where("lodges_id", $id)->delete();
      Lodge::destroy($id);
      return true;
    } else {
      //THE ROOM TYPE IS USED BY OTHERS, HENCE CANNOT BE DELETED;
      return false;
    }
  }
}
