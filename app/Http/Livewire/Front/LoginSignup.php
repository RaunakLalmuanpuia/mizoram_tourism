<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use App\Models\UserOtp;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

class LoginSignup extends Component
{
  public $emailPhone = '';
  public $type = '';
  public $mailSent = false;
  public $signupDialog = false;
  public $existing = false;
  public $user;
  public $enteredOtp;
  public $invalid = false;

  public $listeners = ['login'];

  public function login()
  {
    $this->signupDialog = true;
  }

  public function loginSignup()
  {
    $this->signupDialog = true;
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
    return view('livewire.front.login-signup');
  }
}
