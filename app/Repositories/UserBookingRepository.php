<?php

namespace App\Repositories;

use App\Interfaces\UserBookingRepositoryInterface;
use App\Models\UserBooking;
use App\Models\LodgeRoomData;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Xml\Exception;
use App\Models\Guest;

class UserBookingRepository implements UserBookingRepositoryInterface
{
  public function getAllUserBooking()
  {
    return UserBooking::with(['lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'users'])->get();
  }

  public function createUserBooking(array $userBookingDetails)
  {

    try {
      $userBooking = UserBooking::create($userBookingDetails['data']);
      $userBooking->update([
        'order_id' => $userBookingDetails['order_id'],
      ]);
      foreach ($userBookingDetails['guest'] as $guest) {
        if ($guest['first_name'] != null) {
          $g = new Guest();
          $g->first_name = $guest['first_name'];
          $g->email = $guest['email'];
          $g->phone = $guest['phone'];
          $g->users_id = $userBookingDetails['data']['users_id'];
          $g->booking_id = $userBooking->id;
          $g->save();
        }
      }

      return  $userBooking;
    } catch (Exception $e) {
      Log::debug($e);
      return false;
    }
  }

  public function getUserBookingById($userBookingId)
  {
    return UserBooking::findOrFail($userBookingId);
  }

  public function updateUserBooking($userBookingId, array $newDetails)
  {
    return UserBooking::whereId($userBookingId)->update($newDetails);
  }

  public function deleteUserBooking($userBookingId)
  {
    return UserBooking::destroy($userBookingId);
  }


  public function checkOut($userBookingId)
  {

    //param1 = checkin status
    //param2 = room number

    $userBooking = UserBooking::find($userBookingId);
    //If param1 is "Booked" or "In" . booking is still active.  if param1 is "Out" checkout is done. booking is inactive
    if ($userBooking->param1 == "Booked") {
      $userBooking->param1 = "In";
    } else if ($userBooking->param1 == "In") {
      $userBooking->param1 = "Out";
    } else if ($userBooking->param1 == "Out") {
      $userBooking->param1 = "Booked";
    } else if ($userBooking->param1 == null) {
      $userBooking->param1 = "Booked";
    }


    $userBooking->save();
    return $userBooking;
  }

  public function getAllTheRooms()
  {
  }
}
