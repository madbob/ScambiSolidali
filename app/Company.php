<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function recurrings()
    {
        return $this->hasMany('App\Recurring');
    }

    public function getAddressStreetAttribute()
    {
        if (strpos($this->address, ',') !== false)
            return substr($this->address, 0, strpos($this->address, ','));
        else
            return $this->address;
    }
}
