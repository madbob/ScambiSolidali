<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function recurrings()
    {
        return $this->hasMany('App\RecurringPick');
    }

    public function currentRecurringPick()
    {
        return $this->recurrings()->where('closed', false)->first();
    }
}
