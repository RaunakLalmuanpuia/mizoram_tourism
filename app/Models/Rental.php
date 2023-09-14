<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[]; 
    protected $with=['rentalRating'];
    public function districtMetaData()
    {
      return $this->belongsTo(DistrictMetaData::class);
    }

    public function rentalRating(){
      return $this->hasMany(RentalRating::class,'rentals_id');
  }

}
