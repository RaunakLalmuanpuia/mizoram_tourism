<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserStatusControllerApi extends Controller
{
  public function checkUserStatus($id)
  {
    $user = User::find($id);

    //If param1 is null or false . booking is still active.  if param1 is true checkout is done. booking is inactive
    if ($user->approved == false)
      $user->approved = true;
    else
      $user->approved = false;

    $user->save();
    return $user;
  }
}
