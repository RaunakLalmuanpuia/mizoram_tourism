<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[]; 
    
    public function category(){
        return $this->belongsTo(Category::class,'categories_id');
    }

      //PIVOT FUNCTION
  public function images(){
    return $this->belongsToMany(Image::class,'notice_images','notices_id','images_id');
  }
}
