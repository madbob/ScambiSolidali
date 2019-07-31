<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender()
    {
        return $this->belongsTo('App\User');
    }

    public function donation()
    {
        return $this->belongsTo('App\Donation');
    }
}
