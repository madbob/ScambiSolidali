<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Date;

class Call extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function donations()
    {
        return $this->hasMany('App\Donation');
    }

    public function printableDate()
    {
        return ucwords(Date::parse($this->created_at)->format('l d F Y'));
    }
}
