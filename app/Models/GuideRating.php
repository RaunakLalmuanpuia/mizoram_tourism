<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuideRating extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded = [];
    protected $table = 'guide_ratings';

    public function guides()
    {
      return $this->belongsTo(Hotel::class,'guides_id');
    }
}
