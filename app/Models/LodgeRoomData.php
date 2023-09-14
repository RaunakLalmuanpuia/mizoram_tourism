<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeRoomData extends Model
{
  use HasFactory;
  use SoftDeletes;
  /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
  protected $guarded = [];
  protected $with = ['lodges', 'lodgeRoomTypes'];

  public function districtMetaData()
  {
    return $this->belongsTo(DistrictMetaData::class);
  }

  public function lodges()
  {
    return $this->belongsTo(Lodge::class);
  }

  public function lodgeRoomTypes()
  {
    return $this->belongsTo(LodgeRoomType::class);
  }

  public function userBookings()
  {
    return $this->hasMany(UserBooking::class);
  }


  //PIVOT FUNCTION
  public function amenities()
  {
    return $this->belongsToMany(Amenity::class, 'room_amenities', 'lodge_room_data_id', 'amenities_id');
  }

  //PIVOT FUNCTION
  public function images()
  {
    return $this->belongsToMany(Image::class, 'room_images', 'lodge_room_data_id', 'images_id');
  }
}
