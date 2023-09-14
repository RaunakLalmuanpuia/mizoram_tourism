<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentalRating extends Model
{
    use HasFactory;
    use SoftDeletes;
    /** GUARDED EMPTY MEANS THAT ALL ATTRIBUTES ARE MASS ASSIIGNABLE */
    protected $guarded = [];
    protected $table = 'rental_ratings';

    public function restuarants()
    {
      return $this->belongsTo(Rental::class,'rentals_id');
    }
}
