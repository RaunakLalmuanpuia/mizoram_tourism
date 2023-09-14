<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class ConfirmOtp extends Component
{
  public $otpConfirmed = false;
  public $showPassword = false;
  public $type;

  public $email;
  public $phone;
  public $name;
  public $password;
  public $pledged = false;

  protected $listeners = ['otpVerified'];

  public function showPassword()
  {
    $this->showPassword = !$this->showPassword;
  }

  public function otpVerified($data)
  {
    $this->otpConfirmed = true;
    $this->type = $data['type'];
    $this->type == 'phone' ? $this->phone = $data['emailPhone'] : $this->email = $data['emailPhone'];
  }

  public function registerUser()
  {
    $this->validate([
      'name' => ['required'],
      'email' => ['required', 'unique:users,email'],
      'phone' => ['required', 'unique:users,phone'],
    ]);
    $user = new User;
    $user->name = $this->name;
    $user->email = $this->email;
    $user->phone = $this->phone;
    $user->password = bcrypt('neverusethispassword');
    $user->save();

    Auth::login($user);
    return redirect(request()->header('Referer'));
  }

  public function render()
  {
    return view('livewire.front.confirm-otp');
  }
}
