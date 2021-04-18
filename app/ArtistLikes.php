<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistLikes extends Model
{
    protected $fillable = [

        'artist_id', 'user_id'

    ];
}
