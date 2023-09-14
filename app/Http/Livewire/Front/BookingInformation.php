<?php

namespace App\Http\Livewire\Front;

use App\Models\Guest;
use App\Models\LodgeRoomData;
use App\Models\UserBooking;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class BookingInformation extends Component
{
  public $addGuestDialog = false;
  public $below12Years = false;
  public $newGuestName;
  public $bookingData;
  public $specialRequest;
  public $suggestion;

  public $guests = [];

  public function mount()
  {
    $guest = [
      'name' => Auth::user()->name,
      'email' => Auth::user()->email,
      'phone' => Auth::user()->phone,
    ];
    array_push($this->guests, $guest);
  }

  public function addNewGuest($name, bool $below12)
  {
    if ($name != '') {
      $guest = [
        'name' => $name,
        'below12' => $below12 == 1 ? true : false
      ];
      array_push($this->guests, $guest);
      $this->addGuestDialog = false;
      $this->newGuestName = '';
      $this->below12Years = false;
      $this->emit('guestAdded', ['guests' => $this->guests]);
    }
  }

  public function below12()
  {
    $this->below12Years = !$this->below12Years;
  }

  public function addGuest()
  {
    $this->addGuestDialog = true;
  }

  public function removeGuest($index)
  {
    unset($this->guests[$index]);
    $this->guests = array_values($this->guests);
    $this->emit('guestRemoved', ['guests' => $this->guests]);
  }

  public function makePayment()
  {
    $orderId = 'MZTOUR' . now()->timestamp;

    $booking = new UserBooking;
    $lodgeRoomData = LodgeRoomData::where('lodges_id', $this->bookingData['lodge']['id'])
      ->where('lodge_room_types_id', $this->bookingData['roomType']['id'])->first();
    $booking->lodge_room_data_id = $lodgeRoomData->id;
    $booking->order_id = $orderId;
    $booking->users_id = Auth::user()->id;
    $booking->number_of_room_require = $this->bookingData['noOfRooms'];
    $booking->check_in = $this->bookingData['checkIn'];
    $booking->check_out = $this->bookingData['checkOut'];
    $booking->status = 1;
    $booking->save();

    // save booking
    // $guest->booking_id = $booking->id;
    // $guest->users_id = Auth::user()->id;
    // $guest->first_name = $this->guests[0]['name'];
    // $guest->email = $this->guests[0]['email'];
    // $guest->phone = $this->guests[0]['phone'];
    // $guest->suggestion = $this->suggestion;
    // $guest->save();
    // dd(count($this->guests));

    for ($i = 1; $i < count($this->guests); $i++) {
      $guest = new Guest;
      $guest->users_id = Auth::user()->id;
      $guest->booking_id = $booking->id;
      $guest->first_name = $this->guests[$i]['name'];
      $guest->email = $this->guests[0]['email'];
      $guest->phone = $this->guests[0]['phone'];
      $guest->suggestion = $this->suggestion;
      $guest->param1 = $this->guests[$i]['below12'] == 1 ? true : false;
      $guest->save();
    }

    // proceed for payment

    $callbackUrl = URL::to('/') . '/response-handler';
    if (Auth::user()->id == 304) {
      $amount = 1;
    } else {
      $amount = $this->bookingData['amount'];
    }

    $client = new Client();
    $url = env('APP_ENV') == 'local' ? 'https://paymentgw.mizoram.gov.in/api/initiate-test-payment' : 'https://paymentgw.mizoram.gov.in/api/initiate-payment';
    $response = $client->request('POST', $url, [
      'form_params' => [
        'callback_url' => $callbackUrl,
        'order_id' => $orderId,
        'amount' => $amount,
        'department_id' => 3,
        'customer' => json_encode('MZTOUR: ' . $this->bookingData['lodge']['name']),
        'shouldSplit' => true,
        'splitMethod' => 'PERCENTAGE',
        'splitMid' => 'ZUnFVOlw678076036222',
        'splitPercentage' => 100,
      ]
    ]);
    $response = json_decode($response->getBody());
    session()->forget('bookingData');

    return redirect($response);
  }

  public function render()
  {
    return view('livewire.front.booking-information');
  }
}
