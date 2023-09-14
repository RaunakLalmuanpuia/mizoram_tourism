<?php

namespace App\Http\Livewire\Front;

use App\Models\BookedDates;
use App\Models\Lodge;
use App\Models\LodgeRoomData;
use App\Models\LodgeRoomType;
use App\Models\User;
use App\Models\UserBooking;
use App\Models\UserOtp;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Throwable;

// use function PHPSTORM_META\type;

class Booking extends Component
{
  public $lodges;
  public $selectedLodge;
  public $selectedLodgeId;
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
  public $noLodgeAvailable = false;

  // login for mobile users;
  public $signupDialog = false;
  public $emailPhone = '';
  public $type = '';
  public $mailSent = false;
  public $existing = false;
  public $user;
  public $enteredOtp;
  public $invalid = false;

  public function mount()
  {
    if(session()->exists('bookingData')){ //check if session for current booking exist
      //this is done to retrieve data when users want to modify their bookings in booking page
      $bookingData = session()->pull('bookingData');

      $this->checkIn = $bookingData["checkIn"];
      $this->checkOut = $bookingData["checkOut"];
      $this->selectedInDay = date('l', strtotime($bookingData["checkIn"]));
      $this->selectedOutDay = date('l', strtotime($bookingData["checkOut"]));

      $roomTypes = LodgeRoomType::pluck('id');
      $rooms = LodgeRoomData::whereIn('lodge_room_types_id', $roomTypes)->where('param1', 'Enable')->pluck('lodges_id');

      $this->lodges = Lodge::whereIn('id', $rooms)->with('districtMetaData')->orderBy('name', 'ASC')->get() ?? [];
      $this->selectedLodge = $bookingData['lodge'];
      $this->selectedLodgeId = $this->selectedLodge['id'];
      $roomType = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('param1', 'Enable')->get()->pluck('lodge_room_types_id');

      $this->selectedRoomType = $bookingData['roomType'];
      $this->noOfRooms = $bookingData['noOfRooms'];
      $this->price = $bookingData['amount'];

      $this->roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge)->where('lodge_room_types_id', $this->selectedRoomType)->first();
      $this->roomTypes = LodgeRoomType::whereIn('id', $roomType)->get();

      $roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('lodge_room_types_id', $this->selectedRoomType['id'])->first();

      $period = CarbonPeriod::create($this->checkIn, date('Y-m-d', strtotime('-1 day', strtotime($this->checkOut))));
      $dates = [];

      foreach ($period as $date) {
        array_push($dates, $date->format('Y-m-d'));
      }

      $bookedDates = BookedDates::whereIn('booked', $dates)
        ->get()
        ->pluck('user_booking_id');

      // using param1 as booking status
      $bookedRooms = UserBooking::whereIn('id', $bookedDates->unique())->where('status', 'Confirmed')->where('param1', '!=', 'Out')->where('lodge_room_data_id', $this->roomsAvailable->id)->sum('number_of_room_require');

      $this->noOfRoomsAvailable = $roomsAvailable->room_available - $bookedRooms;
    }else{
      $this->checkIn = date_format(today(), 'Y-m-d');
      $this->checkOut = date_format(today()->addDay(), 'Y-m-d');
      $this->selectedInDay = date('l', strtotime($this->checkIn));
      $this->selectedOutDay = date('l', strtotime($this->checkOut));

      $roomTypes = LodgeRoomType::pluck('id');
      $rooms = LodgeRoomData::whereIn('lodge_room_types_id', $roomTypes)->where('param1', 'Enable')->pluck('lodges_id');

      $this->lodges = Lodge::whereIn('id', $rooms)->with('districtMetaData')->orderBy('name', 'ASC')->get() ?? [];
      $this->selectedLodge = Lodge::whereIn('id', $rooms)->with('districtMetaData')->orderBy('name', 'ASC')->first()->toArray();
      $this->selectedLodgeId = $this->selectedLodge['id'];
      $roomType = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('param1', 'Enable')->get()->pluck('lodge_room_types_id');

      $this->selectedRoomType = LodgeRoomType::whereIn('id', $roomType)->first()->toArray();

      $this->roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge)->where('lodge_room_types_id', $this->selectedRoomType)->first();
      $this->price = $this->roomsAvailable->price * $this->noOfRooms * $this->noOfDays;
      $this->roomTypes = LodgeRoomType::whereIn('id', $roomType)->get();
      $this->getNoOfRooms();
    }
  }

  public function updatedSelectedLodgeId()
  {
    $lodge = Lodge::where('id', $this->selectedLodgeId)->with('districtMetaData')->first()->toArray();
    $this->selectedLodge = $lodge;
    $roomType = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('param1', 'Enable')->get()->pluck('lodge_room_types_id');
    $this->selectedRoomType = LodgeRoomType::whereIn('id', $roomType)->first()->toArray();
    $this->roomTypes = LodgeRoomType::whereIn('id', $roomType)->get();
    $this->roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('lodge_room_types_id', $this->selectedRoomType)->first();

    $this->checkIn = date_format(today(), 'Y-m-d');
    $this->checkOut = date_format(today()->addDay(), 'Y-m-d');
    $this->selectedInDay = date('l', strtotime($this->checkIn));
    $this->selectedOutDay = date('l', strtotime($this->checkOut));

    $date1 = new DateTime($this->checkIn);
    $date2 = new DateTime($this->checkOut);
    $interval = $date1->diff($date2);
    $this->noOfDays = (int) $interval->format('%a');

    $this->noOfRooms = 1;

    $this->price = $this->roomsAvailable->price * $this->noOfRooms * $this->noOfDays;

    $this->getNoOfRooms();
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

  public function selectLodge($lodge)
  {
    $this->selectedLodge = $lodge;
    $roomType = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('param1', 'Enable')->get()->pluck('lodge_room_types_id');
    $this->selectedRoomType = LodgeRoomType::whereIn('id', $roomType)->first()->toArray();
    $this->roomTypes = LodgeRoomType::whereIn('id', $roomType)->get();
    $this->roomsAvailable = LodgeRoomData::where('lodges_id', $this->selectedLodge['id'])->where('lodge_room_types_id', $this->selectedRoomType)->first();

    $this->checkIn = date_format(today(), 'Y-m-d');
    $this->checkOut = date_format(today()->addDay(), 'Y-m-d');
    $this->selectedInDay = date('l', strtotime($this->checkIn));
    $this->selectedOutDay = date('l', strtotime($this->checkOut));

    $date1 = new DateTime($this->checkIn);
    $date2 = new DateTime($this->checkOut);
    $interval = $date1->diff($date2);
    $this->noOfDays = (int) $interval->format('%a');

    $this->noOfRooms = 1;

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

    // dd($this->roomsAvailable->id);

    // using param1 as booking status
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
      // When a customer book lodge/hotel store the current data in session
      // this will help to modify booking data by going to booking page
      session(['bookingData' => $data]);
      return redirect()->route('bookingInformation', $data);
    } else {
      $this->signupDialog = true;
    }
  }

  public function createUser()
  {
    $otp = rand(1000, 9999);
    $templateId = '1407164844795741418';

    $userOtp = UserOtp::firstOrNew(['type' => $this->type, 'contact' => $this->emailPhone]);
    $userOtp->otp = $otp;
    $userOtp->save();

    $this->user = User::where($this->type, $this->emailPhone)->first();
    if ($this->user != null) {
      $this->existing = true;
    }

    if ($this->type == 'email') {
      $this->mailSent = true;
      try {
        $res = Mail::send(
          'emails.registration-mail',
          ['otp' => $otp],
          function ($message) {
            $message->to($this->emailPhone)
              ->subject('OTP for registration');
            $message->from('noreply@gmail.com', 'OTP For Registration');
          }
        );
        $this->mailSent = true;
      } catch (Throwable $ex) {
        Log::info($ex);
        $this->mailSent = false;
      }
    } else {
      try {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sms.msegs.in/api/send-sms?template_id=' . $templateId . '&message=Your OTP for Login/Registration to MZtour is ' . $otp . '.&recipient=' . $this->emailPhone,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 11|Bzz867LIgOYkk8hVterz3KSsDY8Cmjg5FV7C2N7d'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $this->mailSent = true;
      } catch (Throwable $ex) {
        Log::info($ex);
        $this->mailSent = false;
      }
    }
  }

  public function goBack()
  {
    $this->mailSent = false;
  }

  public function verifyOtp()
  {
    $userOtp = UserOtp::where('contact', $this->emailPhone)->where('otp', $this->enteredOtp)->first();
    if ($userOtp != null) {
      $this->invalid = false;
      $userOtp->delete();
      if ($this->existing) {
        Auth::login($this->user);
        return redirect(request()->header('Referer'));
      }
      $data = [
        'type' => $this->type,
        'emailPhone' => $this->emailPhone,
      ];

      $this->signupDialog = false;
      $this->emit('otpVerified', $data);
    } else {
      $this->invalid = true;
    }
  }

  public function updatedEmailPhone()
  {
    if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this->emailPhone)) {
      $this->type = 'email';
    } elseif (preg_match("/^\d+$/", $this->emailPhone)) {
      $this->type = 'phone';
    } else {
      $this->type = '';
    }
  }

  public function render()
  {
    return view('livewire.front.booking');
  }
}
