<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[];
    
    //PIVOT FUNCTION
     public function districtMetaData(){
        return $this->belongsToMany(DistrictMetaData::class,'district_images','images_id','district_meta_data_id');
    }
    
    //PIVOT FUNCTION
    public function districtTopDestinations(){
        return $this->belongsToMany(DistrictTopDestination::class,'destination_images','images_id','district_top_destinations_id');
    }


    //PIVOT FUNCTION
    public function lodges(){
        return $this->belongsToMany(Lodge::class,'lodge_images','images_id','lodges_id');
    }

    //PIVOT FUNCTION
    public function lodgeRoomData(){
        return $this->belongsToMany(LodgeRoomData::class,'room_images','images_id','lodge_room_data_id');
    }

    //PIVOT FUNCTION
    public function about(){
        return $this->belongsToMany(About::class,'about_images','images_id','abouts_id');
    }

    //PIVOT FUNCTION
    public function festival(){
        return $this->belongsToMany(Festival::class,'festival_images','images_id','festivals_id');
    }

    //PIVOT FUNCTION
    public function distance(){
        return $this->belongsToMany(Distance::class,'distance_images','images_id','distances_id');
    }

    //PIVOT FUNCTION
    public function notices(){
        return $this->belongsToMany(Notice::class,'notice_images','images_id','notices_id');
    }

    //PIVOT FUNCTION
    public function carousals(){
        return $this->belongsToMany(Carousal::class,'carousal_images','images_id','carousals_id');
    }

}
