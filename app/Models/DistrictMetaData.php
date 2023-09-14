<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistrictMetaData extends Model
{
  use HasFactory;
  use SoftDeletes;

  /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
  protected $guarded = [];

  public function lodge()
  {
    return  $this->hasMany(Lodge::class);
  }

  public function districtTopDestination()
  {
    return $this->hasMany(DistrictTopDestination::class);
  }

  public function quotes()
  {
    return $this->hasMany(Quote::class);
  }

  public function hotel()
  {
    return $this->hasMany(Hotel::class);
  }
  public function restaurant()
  {
    return $this->hasMany(Restaurant::class);
  }
  public function operator()
  {
    return $this->hasMany(Operator::class);
  }
  public function rental()
  {
    return $this->hasMany(Rental::class);
  }
  public function agent()
  {
    return $this->hasMany(Agent::class);
  }
  public function guide()
  {
    return $this->hasMany(Guide::class);
  }
  // public function hotelRating(){
  //     return $this->hasMany(HotelRating::class,'hotels_id');
  // }
  //PIVOT FUNCTION
  public function images()
  {
    return $this->belongsToMany(Image::class, 'district_images', 'district_meta_data_id', 'images_id');
  }
}
