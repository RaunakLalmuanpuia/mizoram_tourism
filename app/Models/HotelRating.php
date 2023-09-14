<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelRating extends Model
{
  use HasFactory;
  use SoftDeletes;
  /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
  protected $guarded = [];
  protected $table = 'hotel_ratings';

  public function hotels()
  {
    return $this->belongsTo(Hotel::class, 'hotels_id');
  }
  // public function district()
  // {
  //   return $this->belongsTo(DistrictMetaData::class,'hotels_id');
  // }
}
