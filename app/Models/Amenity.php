<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use HasFactory;
    use SoftDeletes;
   // protected $table = 'amenities';
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[]; 

    //PIVOT FUNCTION
    public function lodges(){
        return $this->belongsToMany(Lodge::class,'lodge_amenities','amenities_id','lodges_id');
    }

    //PIVOT FUNCTION
    public function rooms(){
        return $this->belongsToMany(LodgeRoomData::class,'room_amenities','amenities_id','lodge_room_data_id');
    }
}
