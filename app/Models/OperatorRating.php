<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperatorRating extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded = [];
    protected $table = 'operator_ratings';

    public function operators()
    {
      return $this->belongsTo(Operator::class,'operators_id');
    }
}
