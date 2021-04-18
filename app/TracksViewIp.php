<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TracksViewIp extends Model
{
    protected $fillable = [

        'track_id', 'visitor_ip'

    ];
}
