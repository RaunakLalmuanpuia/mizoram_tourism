<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserBooking as ModelsUserBooking;
use Livewire\Component;
use Throwable;

class UserBooking extends Component
{
  public $bookings;
  public $cancelBooking = false;
  public $bookingId;

  public function onCancelClicked($id)
  {
    $this->cancelBooking = true;
    $this->bookingId = $id;
  }

  public function onCancelled()
  {
    $booking = ModelsUserBooking::findOrFail($this->bookingId);
    $booking->cancelled_at = now();
    $booking->status = 'Cancelled';
    $booking->save();
    $this->cancelBooking = false;

    $this->sendSms($booking->users_id);

    session()->flash('flash.banner', 'Your booking has been cancelled.');
    session()->flash('flash.bannerStyle', 'success');

    return redirect(request()->header('Referer'));
  }

  public function sendSms($userId)
  {
    $user = User::findOrFail($userId);
    $templateId = '1407164844802974092';
    try {

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sms.msegs.in/api/send-sms?template_id=' . $templateId . '&message=Dear ' . $user->name . ' , your Booking has been cancelled. please login to https://mizoramtourism.com for details' . '&recipient=' . $user->phone,
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
    } catch (Throwable $ex) {
      info($ex);
    }
  }

  public function dialogCancel()
  {
    $this->cancelBooking = false;
  }

  public function render()
  {
    return view('livewire.user-booking');
  }
}
