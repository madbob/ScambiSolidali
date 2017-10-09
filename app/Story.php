<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public function getCoverUrlAttribute()
    {
        return '/stories/' . $this->id;
    }
}
