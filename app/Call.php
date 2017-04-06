<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function donations()
    {
        return $this->hasMany('App\Donation');
    }

    public function getImageAttribute()
    {
        if ($this->status == 'archived') {
            $donations = $this->donations;
            if ($donations->isEmpty())
                return null;

            $donation = $donations->first();
            return $donation->imageUrl(0);
        }
        else {
            return $this->category->icon;
        }
    }
}
