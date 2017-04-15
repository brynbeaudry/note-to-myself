<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delete', 'url'
    ];
      //
      /**
       * The table associated with the model.
       *
       * @var string
       */
      protected $table = 'images';

}
