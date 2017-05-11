<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    public function printableName()
    {
        return $this->name;
    }

    public function donations()
    {
        return $this->belongsToMany('App\Donation')->orderBy('donation_receiver.updated_at', 'desc')->withPivot(['receiver_id', 'donation_id', 'operator_id', 'updated_at', 'notes', 'status']);
    }
}
