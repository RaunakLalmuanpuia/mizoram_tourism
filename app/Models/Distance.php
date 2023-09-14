<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distance extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'amenities';
     /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[]; 

     //PIVOT FUNCTION
     public function images(){
        return $this->belongsToMany(Image::class,'distance_images','distances_id','images_id');
    }

 
}
