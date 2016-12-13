<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function donations()
    {
        return $this->hasMany('App\Donation');
    }

    public function lastDonation()
    {
        return $this->donations()->orderBy('created_at', 'desc')->first();
    }

	public function printableName()
	{
		return $this->name . ' ' . $this->surname;
	}

	public function getRatingAttribute()
	{
		$rating = 0;
        $count = 0;

		foreach($this->donations as $d)
            if ($d->rating != 0) {
                $rating += $d->rating;
                $count++;
            }

        if ($count > 0)
            return ceil($rating / $count);
        else
            return 0;
	}
}
