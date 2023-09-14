<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
  use HasFactory;
  use SoftDeletes;
  /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
  protected $guarded = [];
 
  public function districtTopDestinations()
  {
    return $this->belongsToMany(DistrictTopDestination::class, 'destinations_tags', 'tags_id', 'district_top_destinations_id',);
  }
  
}
