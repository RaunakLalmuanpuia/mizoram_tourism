<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guide extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[]; 
    protected $with = ['guideRating'];

    public function districtMetaData()
    {
      return $this->belongsTo(DistrictMetaData::class);
    }

    public function guideRating(){
      return $this->hasMany(GuideRating::class,'guides_id');
  }
}
