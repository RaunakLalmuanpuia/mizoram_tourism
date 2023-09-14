<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
  public function updateProfile(Request $request)
  {
    $user = User::findOrFail($request->user_id);
    if ($request->avatar != $user->profile_photo_path) {
      try {
        Storage::disk('public')->delete($user->profile_photo_path);
      } catch (Exception $e) {
        Log::info('trying to delete null image');
      }
      $file = $this->storeImage('basic_info', $request->avatar);
      $user->profile_photo_path = $file;
    }
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->save();
    return response()->json(['success' => 'Profile updated successfully']);
  }

  public function storeImage($path, $base64Image)
  {
    $image_64 = $base64Image;
    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
    $image = substr($image_64, strpos($image_64, ',') + 1);
    $imageName = Str::random(30) . date('YmdHis') . '.' . $extension;
    $pathUrl = $path . '/' . $imageName;
    $filePath = Storage::disk('public')->put($pathUrl, base64_decode($image), 'public');
    return $pathUrl;
  }
}
