<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lodge extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[];
    protected $with=['lodgeRating'];
    
    public function districtMetaData(){
        return $this->belongsTo(DistrictMetaData::class);
    }

    public function lodgeRoomData(){
        return $this->hasMany(LodgeRoomData::class);
    }

    // public function report(){
    //     return $this->hasMany(Report::class);
    // }

 

    //PIVOT FUNCTION
    public function amenities(){
        return $this->belongsToMany(Amenity::class,'lodge_amenities','lodges_id','amenities_id');
    }

    //PIVOT FUNCTION
    public function images(){
        return $this->belongsToMany(Image::class,'lodge_images','lodges_id','images_id');
    }
    //PIVOT FUNCTION
    public function users(){
        return $this->belongsToMany(User::class,'user_lodges','lodges_id','users_id');
    }

    public function lodgeRating(){
        return $this->hasMany(LodgeRating::class,'lodges_id');
    }
}
