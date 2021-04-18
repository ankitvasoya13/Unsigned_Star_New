<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $guarded = [];

    public function frontUser()
    {
        return $this->belongsTo('App\FrontUser', 'front_user_id');
    }
}
