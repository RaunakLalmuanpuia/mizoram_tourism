<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lodge(){
      return $this->belongsToMany(Lodge::class,'user_lodges','users_id','lodges_id');
    }

    public function reportDetails(){
        return $this->hasMany(ReportDetail::class,'reports_id');
    }
}
