<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

        'heading_1', 'heading_2', 'description', 'slider_image', 'button_url', 'status'

    ];

}
