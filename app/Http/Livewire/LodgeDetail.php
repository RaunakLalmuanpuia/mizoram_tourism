<?php

namespace App\Http\Livewire;

use App\Models\BookedDates;
use App\Models\Lodge;
use App\Models\LodgeRoomData;
use App\Models\LodgeRoomType;
use App\Models\UserBooking;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LodgeDetail extends Component
{
  public $lodge;
  public $amenities;
  public $lodgeRooms;

  public $lodges;
  public $selectedLodge;
  public $checkIn;
  public $checkOut;
  public $roomTypes;
  public $selectedRoomType;
  public $selectedInDay;
  public $selectedOutDay;
  public $noOfRooms = 1;
  public $roomsAvailable;
  public $price;
  public $noOfRoomsAvailable;
  public $noOfDays = 1;
  public $haveRooms = true;

  public $lodgeGallery;

  public function mount()
  {
    $this->checkIn = date_format(today(), 'Y-m-d');
    $this->checkOut = date_format(today()->addDay(), 'Y-m-d');
    $this->selectedInDay = date('l', strtotime($this->checkIn));
    $this->selectedOutDay = date('l', strtotime($this->checkOut));
    $this->lodges = Lodge::with('districtMetaData')->get();

    $this->selectedLodge = Lodge::where('id', $this->lodge->id)->with('districtMetaData')->first()->toArray();
    $roomType = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('param1', 'Enable')->get()->pluck('lodge_room_types_id');
    if (count($roomType) != 0 && LodgeRoomType::whereIn('id', $roomType)->count() != 0) {
      $this->selectedRoomType = LodgeRoomType::whereIn('id', $roomType)->first()->toArray();

      $this->roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge)->where('lodge_room_types_id', $this->selectedRoomType)->first();
      $this->price = $this->roomsAvailable->price * $this->noOfRooms * $this->noOfDays;
      $this->roomTypes = LodgeRoomType::whereIn('id', $roomType)->get();
      $this->getNoOfRooms();
    } else {
      $this->haveRooms = false;
    }
  }

  public function updatedCheckIn($date)
  {
    $this->selectedInDay = date('l', strtotime($date));
    $this->checkOut = date('Y-m-d', strtotime("+1 day", strtotime($date)));
    $this->selectedOutDay = date('l', strtotime($this->checkOut));
    $this->noOfDays = 1;
    $this->getNoOfRooms();
  }

  public function updatedCheckOut($date)
  {
    $this->selectedOutDay = date('l', strtotime($date));
    $date1 = new DateTime($this->checkIn);
    $date2 = new DateTime($this->checkOut);
    $interval = $date1->diff($date2);
    $this->noOfDays = (int) $interval->format('%a');
    $this->price = $this->roomsAvailable->price * $this->noOfRooms * $this->noOfDays;
    $this->getNoOfRooms();
  }

  public function selectRoomType($roomType)
  {
    $this->selectedRoomType = $roomType;
    $this->roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('lodge_room_types_id', $this->selectedRoomType)->first();
    $this->price = $this->roomsAvailable->price * $this->noOfRooms * $this->noOfDays;
    $this->getNoOfRooms();
  }

  public function selectNoOfRooms($no)
  {
    $this->noOfRooms = $no;
    $this->price = $this->roomsAvailable->price * $this->noOfDays * $this->noOfRooms;
  }

  public function getNoOfRooms()
  {
    $roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('lodge_room_types_id', $this->selectedRoomType['id'])->first();

    $period = CarbonPeriod::create($this->checkIn, date('Y-m-d', strtotime('-1 day', strtotime($this->checkOut))));
    $dates = [];

    foreach ($period as $date) {
      array_push($dates, $date->format('Y-m-d'));
    }

    $bookedDates = BookedDates::whereIn('booked', $dates)
      ->get()
      ->pluck('user_booking_id');

    $bookedRooms = UserBooking::whereIn('id', $bookedDates->unique())->where('status', 'Confirmed')->where('param1', '!=', 'Out')->where('lodge_room_data_id', $this->roomsAvailable->id)->sum('number_of_room_require');

    $this->noOfRoomsAvailable = $roomsAvailable->room_available - $bookedRooms;

    if ($this->noOfRoomsAvailable <= 0) {
      $this->noOfRooms = 0;
      $this->price = $this->roomsAvailable->price * $this->noOfDays * $this->noOfRooms;
    } else {
      $this->noOfRooms = 1;
      $this->price = $this->roomsAvailable->price * $this->noOfDays * $this->noOfRooms;
    }
  }

  public function proceedBooking()
  {
    if (Auth::check()) {
      $data = [
        'lodge' => $this->selectedLodge,
        'checkIn' => $this->checkIn,
        'checkOut' => $this->checkOut,
        'roomType' => $this->selectedRoomType,
        'noOfRooms' => $this->noOfRooms,
        'amount' => $this->price,
      ];
      return redirect()->route('bookingInformation', $data);
    } else {
      $this->emit('login');
    }
  }

  public function render()
  {
    return view('livewire.lodge-detail');
  }
}
