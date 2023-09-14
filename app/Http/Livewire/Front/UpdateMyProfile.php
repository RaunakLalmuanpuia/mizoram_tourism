<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateMyProfile extends Component
{
  use WithFileUploads;
  public $avatar;
  public $name;
  public $address;
  public $phone;
  public $email;
  public $existingPhoto;

  public function mount()
  {
    $this->name = Auth::user()->name;
    $this->email = Auth::user()->email;
    $this->phone = Auth::user()->phone;
    $this->avatar = Auth::user()->profile_photo_path;
    $this->address = Auth::user()->address;
    $this->existingPhoto = Auth::user()->profile_photo_path != null ? true : false;
  }

  public function updatedAvatar()
  {
    $this->validate(['avatar' => 'image']);
  }

  public function updateProfile()
  {
    $user = User::findOrFail(Auth::user()->id);
    $user->name = $this->name;
    $user->email = $this->email;
    $user->phone = $this->phone;
    $user->address = $this->address;
    if ($this->avatar != Auth::user()->profile_photo_path) {
      try {
        Storage::disk('public')->delete($this->avatar);
      } catch (Exception $e) {
        Log::info('trying to delete null image');
      }
      $imageURL = $this->avatar->storePublicly('avatars', 'public');
      $user->profile_photo_path = $imageURL;
    }
    $user->save();

    session()->flash('flash.banner', 'Profile updated successfully');
    session()->flash('flash.bannerStyle', 'success');
    return redirect('/my-profile');
  }

  public function render()
  {
    return view('livewire.front.update-my-profile');
  }
}
