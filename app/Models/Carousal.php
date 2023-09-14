<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousal extends Model
{
    use HasFactory;
     /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
     protected $guarded=[]; 
 
    //PIVOT FUNCTION
    public function images(){
        return $this->belongsToMany(Image::class,'carousal_images','carousals_id','images_id');
    }

}
