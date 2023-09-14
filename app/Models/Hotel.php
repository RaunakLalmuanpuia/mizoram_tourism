<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Hotel extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $with = ['hotelRating'];

  /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
  protected $guarded = [];

  public function districtMetaData()
  {
    return $this->belongsTo(DistrictMetaData::class);
  }

  public function hotelRating()
  {
    return $this->hasMany(HotelRating::class, 'hotels_id');
  }
}
