<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistrictTopDestination extends Model
{
  use HasFactory;
  use SoftDeletes;
  /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
  protected $guarded = [];
  protected $with=['images'];
  public function districtMetaData()
  {
    return $this->belongsTo(DistrictMetaData::class);
  }

  //PIVOT FUNCTION
  public function tags()
  {
    return $this->belongsToMany(Tag::class, 'destinations_tags', 'district_top_destinations_id', 'tags_id');
  }

  //PIVOT FUNCTION
  public function images(){
    return $this->belongsToMany(Image::class,'destination_images','district_top_destinations_id','images_id');
  }

}
