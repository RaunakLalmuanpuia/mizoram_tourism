<?php

namespace App\Repositories;

use App\Interfaces\GuestRepositoryInterface;
use App\Models\Guest;
use App\Models\User;

class GuestRepository implements GuestRepositoryInterface
{
  public function getAllGuest()
  {
    return User::with('guests')->get();
  }


  public function createGuest(array $guestDetails)
  {
    return Guest::create($guestDetails);
  }

  public function getGuestById($guestId)
  {
    return Guest::findOrFail($guestId);
  }

  public function updateGuest($guestId, array $newDetails)
  {
    return Guest::whereId($guestId)->update($newDetails);
  }

  public function deleteGuest($guestId)
  {
    return Guest::destroy($guestId);
  }
}
