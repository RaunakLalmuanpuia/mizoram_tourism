<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBooking extends Model
{
  use HasFactory;
  use SoftDeletes;
  /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
  protected $guarded = [];

  public function lodgeRoomData()
  {
    return $this->belongsTo(LodgeRoomData::class);
  }

  public function guests()
  {
    return $this->hasMany(Guest::class, 'booking_id', 'id');
  }


  public function users()
  {
    return $this->belongsTo(User::class);
  }

  public function payment()
  {
    return $this->hasOne(Payment::class, 'orderId', 'order_id');
  }
}
