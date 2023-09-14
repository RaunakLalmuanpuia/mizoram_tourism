<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LodgeRoomType extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[]; 
    
    
    public function lodgeRoomData(){
        return $this->hasMany(LodgeRoomData::class);
    }
}
