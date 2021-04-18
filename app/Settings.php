<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $fillable = [

        'name', 'value', 'status',

    ];


    public static function getSettingValue($name){

        $settingData = Settings::where('name', '=', $name)->first();

        return $settingData->value;
    }
}
