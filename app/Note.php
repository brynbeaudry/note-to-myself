<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'userId',
    ];
      //
      /**
       * The table associated with the model.
       *
       * @var string
       */
      protected $table = 'notes';
}
