<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Festival extends Model
{
    use HasFactory;
    use SoftDeletes;
     /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
     protected $guarded=[]; 
 
    //PIVOT FUNCTION
    public function images(){
        return $this->belongsToMany(Image::class,'festival_images','festivals_id','images_id');
    }
}
