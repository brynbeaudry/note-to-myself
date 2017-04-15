<?php

namespace App;
use Note;
use TBD;
use Image;
use Website;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','email_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function note()
    {
        return $this->hasOne('Note', 'userId');
    }

    public function images()
    {
        return $this->hasMany('Image', 'userId');
    }

    public function websites()
    {
        return $this->hasOne('Website','userId');
    }

    public function tbd()
    {
        return $this->hasOne('Website','userId');
    }
}
