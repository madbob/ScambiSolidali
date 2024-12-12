<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public static function getConf($name)
    {
        $c = Config::where('name', $name)->first();

        if ($c == null) {
            return '';
        }
        else {
            return $c->value;
        }
    }
}
