<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[];
    protected $with=['restaurantRating'];
    public function districtMetaData()
    {
      return $this->belongsTo(DistrictMetaData::class);
    }
    public function restaurantRating(){
      return $this->hasMany(RestaurantRating::class,'restaurants_id');
  }
}
 