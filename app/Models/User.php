<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone' ,'image' , 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    // 

    public function getJWTCustomClaims()
    {
        return [];
    }


    //
    public function reviews()
    {
      return $this->hasMany(Review::class);
    }
    ///

    public function favorites()
    {
      return $this->hasMany(Favorite::class);
    }
    ///

    public function complainations()
    {
      return $this->hasMany(Complaination::class);
    }
    ///

    public function orders()
    {
      return $this->hasMany(Order::class);
    }

}
