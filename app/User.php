<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'password', 'verification_code', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany('App\Donation');
    }

    public function institutes(): BelongsToMany
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

    public function printableOperatorName()
	{
        $institutes = [];
        foreach($this->institutes as $i)
            $institutes[] = $i->name;

		return sprintf('%s %s (%s)', $this->name, $this->surname, join(', ', $institutes));
	}

    public function printableOrganizations()
	{
        $all = [];

        foreach($this->institutes as $i)
            $all[] = $i->name;

        foreach($this->companies as $i)
            $all[] = $i->name;

		return join(', ', $all);
	}

    public static function existingRoles()
    {
        $ret = [
            'user' => (object) [
                'label' => 'Utente',
                'multiple' => 'Utenti',
            ],
            'operator' => (object) [
                'label' => 'Operatore',
                'multiple' => 'Operatori',
            ],
            'admin' => (object) [
                'label' => 'Amministratore',
                'multiple' => 'Amministratori',
            ],
        ];

        if (env('HAS_PUBLIC_OP', false)) {
            $ret['student'] = (object) [
                'label' => 'Studente',
                'multiple' => 'Studenti',
            ];
        }

        return $ret;
    }

    public function getRoleNameAttribute()
    {
        $roles = self::existingRoles();
        if (isset($roles[$this->role])) {
            return $roles[$this->role]->label;
        }
        else {
            Log::error('Utente con ruolo non assegnato: ' . $this->id . ' ' . $this->role);

            if ($this->institutes->count() != 0) {
                $this->role = 'operator';
            }
            else {
                $this->role = 'user';
            }

            $this->save();
            return $this->getRoleNameAttribute();
        }
    }

    public function routeNotificationForMobyt()
    {
        return preg_replace('/[^0-9]/', '', $this->phone);
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

    public function sendActivationNotification()
    {
        $user = $this;

        Mail::send('mails.activation', ['user' => $user], function($message) use ($user){
            $message->to($user->email);
            $message->subject(env('APP_NAME') . ': attivazione account');
        });
    }
}
