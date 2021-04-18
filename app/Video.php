<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

        'artist_id', 'video_file_1', 'video_file_2', 'video_file_3', 'video_file_4', 'video_file_5', 'video_file_6', 'video_file_7', 'video_file_8', 'video_file_9', 'video_file_10'

    ];

}
