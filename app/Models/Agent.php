<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded=[]; 
    protected $with = ['agentRating'];

    public function districtMetaData()
    {
      return $this->belongsTo(DistrictMetaData::class);
    }

    public function agentRating(){
      return $this->hasMany(AgentRating::class,'agents_id');
    }
}
