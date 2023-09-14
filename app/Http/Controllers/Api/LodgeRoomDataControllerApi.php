<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\LodgeRoomDataRepositoryInterface;

use App\Models\LodgeRoomData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookedDates;
use App\Models\User;
use App\Models\UserLodge;
use Illuminate\Support\Collection;
use App\Models\Lodge;
use App\Models\UserBooking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Log;

class LodgeRoomDataControllerApi extends Controller
{
  private LodgeRoomDataRepositoryInterface $lodgeRoomDataRepository;
  public function __construct(LodgeRoomDataRepositoryInterface $lodgeRoomDataRepository)
  {
    $this->lodgeRoomDataRepository = $lodgeRoomDataRepository;
  }

  public function index()
  {
    return [
      'data' => $this->lodgeRoomDataRepository->getAllLodgeRoomData()
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    return [
      'data' => $this->lodgeRoomDataRepository->createLodgeRoomData($request->all())
    ];
  }

  public function show(LodgeRoomData $room)
  {
    return $this->lodgeRoomDataRepository->getLodgeRoomDataById($room->id);
  }

  public function edit(LodgeRoomData $room)
  {
  }

  public function update(Request $request, LodgeRoomData $room)
  {
    return $this->lodgeRoomDataRepository->updateLodgeRoomData($room->id, $request->all());
  }

  public function destroy(LodgeRoomData $room)
  {
    return $this->lodgeRoomDataRepository->deleteLodgeRoomData($room->id);
  }

  public function getTypebyLodge($lodgeId)
  {
    return $this->lodgeRoomDataRepository->getTypebyLodge($lodgeId);
  }

  public function getRoomAvailablePrice($roomId)
  {
    return $this->lodgeRoomDataRepository->getRoomAvailablePrice($roomId);
  }

  public function getRoomsByLodgeId($lodgeId)
  {
    $data = LodgeRoomData::with('lodgeRoomTypes', 'images')->where('param1', 'Enable')->where('lodges_id', $lodgeId)->get();
    return $data;
    // return $this->lodgeRoomDataRepository->getRoomsByLodgeId($lodgeId);
  }

  public function getLodgeAccordingToRole($id)
  {
    $user = User::find($id);

    if ($user['role'] == 'admin') {
      return ['data' => Lodge::with(['districtMetaData', 'amenities'])->get()];
    } else {
      $lodges_id = UserLodge::where('users_id', $user['id'])->pluck('lodges_id')->toArray();
      $c = collect();
      foreach ($lodges_id as $id) {
        $lodge = Lodge::with(['districtMetaData', 'amenities'])->find($id);
        if ($lodge != null) {
          $c->push($lodge);
        }
      }

      return ['data' => $c];
    }
  }

  public function getRoomByLodge($id)
  {
    $lodgeRoomDatas = LodgeRoomData::with(['districtMetaData', 'lodges', 'lodgeRoomTypes', 'amenities'])->where('lodges_id', $id)->get();

    foreach ($lodgeRoomDatas as $r) {
      //1.get the first row and search that id in userbooking
      $mId = $r->id;
      $bookedDates = BookedDates::where('booked', date('Y-m-d', strtotime(Carbon::now())))->get()->pluck('user_booking_id');
      $mUserBooking = UserBooking::where('lodge_room_data_id', $mId)->whereIn('id', $bookedDates)->get();
      $roomOccupied = 0;
      foreach ($mUserBooking as $u) {
        if ($u->param1 != "Out" && $u->status == 'Confirmed') {
          $roomOccupied = $roomOccupied + $u->number_of_room_require;
        }
      }
      $r->room_available_now = ($r->room_available - $roomOccupied) < 1 ? 0 : $r->room_available - $roomOccupied;
    }

    return [
      'data' => $lodgeRoomDatas
    ];
  }

  public function getRoomAvailable(Request $request, $roomId)
  {
    $lodgeRoomDatas = LodgeRoomData::with(['districtMetaData', 'lodges', 'lodgeRoomTypes', 'amenities'])
      ->findOrFail($roomId);

    $mId = $lodgeRoomDatas->id;
    $period = CarbonPeriod::create($request->check_in, date('Y-m-d', strtotime('-1 day', strtotime($request->check_out))));
    $dates = [];

    foreach ($period as $date) {
      array_push($dates, $date->format('Y-m-d'));
    }

    $bookedDates = BookedDates::whereIn('booked', $dates)->get()->pluck('user_booking_id');
    $mUserBooking = UserBooking::where('lodge_room_data_id', $mId)->whereIn('id', $bookedDates->unique())->get();
    $roomOccupied = 0;
    foreach ($mUserBooking as $u) {
      if ($u->param1 != "Out" && $u->status == 'Confirmed') {
        $roomOccupied = $roomOccupied + $u->number_of_room_require;
      }
    }
    $room_available_now = ($lodgeRoomDatas->room_available - $roomOccupied) < 1 ? 0 : $lodgeRoomDatas->room_available - $roomOccupied;
    $lodgeRoomDatas->room_available_now = $room_available_now;
    return [
      'data' => $lodgeRoomDatas
    ];
  }

  public function getRoomPrice($roomId, $roomRequire)
  {
  }

  public function searchAndDelete($id)
  {
    $mRoom = UserBooking::where('lodge_room_data_id', $id)->get();

    if ($mRoom->count() < 1) {
      //IT IS ZERO AND THE ROOM TYPE IS NOT USED | CAN BE DELETED
      LodgeRoomData::destroy($id);
      return true;
    } else {
      //THE ROOM TYPE IS USED BY OTHERS, HENCE CANNOT BE DELETED;
      return false;
    }
  }

  public function getAvailableRoom($roomId)
  {
  }
}
