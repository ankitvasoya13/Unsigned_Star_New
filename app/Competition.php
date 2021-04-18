<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

        'competition_name', 'short_description', 'description', 'venue', 'location', 'featured_image', 'start_datetime', 'end_datatime'

    ];

}
