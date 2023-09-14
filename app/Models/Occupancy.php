<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded = [];

    public function occupancyDetails(){
        return $this->hasMany(OccupancyDetail::class,'occupancies_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    // public function lodge(){
    //     return $this->belongsTo(Lodge::class,'lodges_id');
    // }
}
