<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Donation extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

	public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function receivers()
    {
        return $this->belongsToMany('App\Receiver')->orderBy('donation_receiver.updated_at', 'desc')->withPivot(['receiver_id', 'donation_id', 'operator_id', 'updated_at', 'notes', 'status']);
    }

    public function getPhotoUrlAttribute()
    {
        return Donation::photosPath() . $this->id;
    }

    static public function photosPath()
    {
        return storage_path() . '/app/';
    }

	public function printableAddress()
	{
		return sprintf('%s %s, %s', $this->name, $this->surname, $this->address);
	}

    public function printableStatus()
    {
        switch($this->status) {
            case 'pending':
                return 'In attesa';

            case 'voided':
                return 'Annullato';

            case 'assigned':
                return 'Assegnato';

            case 'recovered':
                return 'Recuperato';

            case 'dropped':
                return 'Abbondonato';
        }

        return '???';
    }

	public function printableContacts()
	{
		return sprintf('%s %s', $this->phone, $this->email);
	}

    static public function declineReasons()
    {
        return [
            'not-available' => (object) [
                'text' => 'Non più disponibile',
                'penalty' => 3
            ],
            'not-matching' => (object) [
                'text' => 'Non conforme alla descrizione',
                'penalty' => 2
            ],
        ];
    }
}
