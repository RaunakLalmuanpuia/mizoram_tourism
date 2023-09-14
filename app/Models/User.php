<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
 use Laravel\Sanctum\HasApiTokens;
//use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
  //use HasApiTokens;
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'phone','role','address'
  ];
  protected $guarded=[];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'profile_photo_url',
  ];

  //CREATE BY LTP 9MAR 22
  //ONE TO MANY WITH 'guests' Table
  public function guests()
  {
    return $this->hasMany(Guest::class, 'users_id');
  }

  public function role()
  {
    return $this->belongsTo(Role::class);
  }

    //PIVOT FUNCTION
  public function lodges(){
    return $this->belongsToMany(Lodge::class,'user_lodges','users_id','lodges_id');
  }

  public function occupancies(){
    return $this->hasMany(Occupancy::class);
  }
  public function districtMetaData()
  {
    return $this->belongsTo(DistrictMetaData::class);
  }

}
