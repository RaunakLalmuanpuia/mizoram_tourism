<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  use HasFactory;

  public function userBooking()
  {
    return $this->belongsTo(UserBooking::class, 'orderId', 'order_id');
  }
}
