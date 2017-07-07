<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
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

    public function bookings()
    {
        return $this->belongsToMany('App\User', 'donation_booking')->orderBy('donation_booking.created_at', 'desc')->withPivot(['created_at']);
    }

    public function receivers()
    {
        return $this->belongsToMany('App\Receiver')->orderBy('donation_receiver.updated_at', 'desc')->withPivot(['receiver_id', 'donation_id', 'operator_id', 'updated_at', 'notes', 'status']);
    }

    public function call()
    {
        return $this->belongsTo('App\Call');
    }

    /*
        Il numero di immagini relative alla donazioni.
        Possono essere accedute all'URL /donazione/image/$id_donazione/$indice
        (dove $indice va da 1 a N)
    */
    public function imagesNum()
    {
        $path = Donation::photosPath();
        $files = glob($path . $this->id . '_*');
        return count($files);
    }

    public function booked($user = null)
    {
        if ($user == null)
            $user = Auth::user();

        return ($this->bookings()->where('user_id', $user->id)->count() != 0);
    }

    static public function photosPath()
    {
        return storage_path() . '/app/';
    }

    public function imageUrl($index)
    {
        if ($this->type == 'service')
            return url('images/tempo.svg');
        else
            return url('donazione/image/' . $this->id . '/' . $index . '?d=' . $this->updated_at);
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

            case 'expiring':
                return 'In Scadenza';

            case 'expired':
                return 'Scaduto';

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
            'user-deleted' => (object) [
                'text' => 'Rimossa dall\'utente',
                'penalty' => 0
            ],
        ];
    }
}
