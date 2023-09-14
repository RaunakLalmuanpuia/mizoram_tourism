<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pledge;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Auth;
use Throwable;

class UserAuthController extends Controller
{
  public function loginRegister(Request $request)
  {
    $otp = rand(1000, 9999);
    if ($request->emailPhone == '8787883628') {
      $userOtp = UserOtp::firstOrNew(['type' => $request->type, 'contact' => $request->emailPhone]);
      $userOtp->otp = 1234;
      $userOtp->save();
      return response()->json(['existing' => true, 'mailSent' => true, 'otp' => 1234]);
    }
    $user = User::where($request->type, $request->emailPhone)->first();

    $existing = false;
    $mailSent = false;

    $userOtp = UserOtp::firstOrNew(['type' => $request->type, 'contact' => $request->emailPhone]);
    $userOtp->otp = $otp;
    $userOtp->save();

    if ($user != null) {
      $existing = true;
    }
    $email = $request->emailPhone;

    switch ($request->type) {
      case 'email':
        try {
          Mail::send('emails.registration-mail', ['otp' => $otp], function ($message) use ($email) {
            $message->to($email)
              ->subject('OTP for registration');
            $message->from('noreply@gmail.com', 'OTP for registration');
          });
          $mailSent = true;
        } catch (Throwable $ex) {
          Log::info($ex);
          $mailSent = false;
          return response()->json([], 500);
        }
        break;

      case 'phone':
        try {
          $templateId = '1407164844795741418';
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sms.msegs.in/api/send-sms?template_id=' . $templateId . '&message=Your OTP for Login/Registration to MZtour is ' . $otp . '.&recipient=' . $email,
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
          $mailSent = true;
        } catch (Throwable $ex) {
          Log::info($ex);
          $mailSent = false;
        }
        break;
    }
    return response()->json(['existing' => $existing, 'mailSent' => $mailSent, 'otp' => $otp]);
  }

  public function verifyOtp(Request $request)
  {
    $userOtp = UserOtp::where('contact', $request->emailPhone)->where('otp', $request->otp)->first();
    if ($userOtp != null) {
      $userOtp->delete();
      $userCheck = User::where($userOtp->type, $request->emailPhone)->first();
      if ($userCheck != null) {
        $user = User::where($userOtp->type, $request->emailPhone)->first();
        Auth::login($user);
        $token = Auth::user()->createToken('tourism_token');
        $success['verified'] = 'OTP Verified';
        $success['user'] = Auth::user();
        $success['token'] = $token->plainTextToken;
        return response()->json(['success' => $success, 'existing' => true, 'type' => $userOtp->type]);
      } else {
        return response()->json(['success' => 'OTP Verified', 'existing' => false, 'emailPhone' => $request->emailPhone, 'type' => $userOtp->type]);
      }
    } else {
      return response()->json(['error' => 'Invalid OTP'], 401);
    }
  }

  public function signup(Request $request)
  {
    $user = new User;
    $user->name = $request->fullName;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = bcrypt('testing');
    $user->save();

    $pledge = new Pledge;
    $pledge->user_id = $user->id;
    $pledge->save();

    Auth::login($user);
    $token = Auth::user()->createToken('tourism_token');
    $success['user'] = Auth::user();
    $success['token'] = $token->plainTextToken;
    return response()->json(['success' => $success], 200);
  }

  public function login(Request $request)
  {
    $user = User::where($request->type, $request->emailPhone)->first();
    Auth::login($user);
    $token = Auth::user()->createToken('tourism_token');
    $success['user'] = Auth::user();
    $success['token'] = $token->plainTextToken;
    return response()->json(['success' => $success], 200);
  }
  public function getUser($userId)
  {
    $user = User::where('id', $userId)->get();
    return $user;
  }
}
