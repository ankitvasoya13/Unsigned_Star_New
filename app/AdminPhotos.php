<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPhotos extends Model
{
    protected $table = 'admin_photos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

        'admin_id', 'photo_file'

    ];

}
