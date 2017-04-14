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
        'name','breed1', 'type', 'breed2','breed3','birthday', 'profileImgPath', 'ownerId',
    ];
      //
      /**
       * The table associated with the model.
       *
       * @var string
       */
      protected $table = 'notes';
}
