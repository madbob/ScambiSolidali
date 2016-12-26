<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Mail;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'password', 'verification_code'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function donations()
    {
        return $this->hasMany('App\Donation');
    }

    public function institutes()
    {
        return $this->belongsToMany('App\Institute');
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

    public function sendPasswordResetNotification($token)
    {
        $user = $this;

        Mail::send('mails.reset', ['token' => $token], function($message) use ($user){
            $message->to($user->email);
            $message->subject(env('APP_NAME') . ': reset password');
        });
    }
}
