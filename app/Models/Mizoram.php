<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mizoram extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','description','image'
    ];
}
