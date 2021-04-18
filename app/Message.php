<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'artist_id', 'panel_member_id', 'message', 'sender'
    ];
}
