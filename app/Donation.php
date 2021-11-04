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

    public function receivers()
    {
        return $this->belongsToMany('App\Receiver')->orderBy('donation_receiver.updated_at', 'desc')->withPivot(['id', 'receiver_id', 'donation_id', 'operator_id', 'updated_at', 'notes', 'status']);
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

    public function getHumanAreaAttribute()
    {
        $areas = self::areas();
        return $areas[$this->area] ?? 'Zona non definita';
    }

    static public function photosPath()
    {
        return storage_path() . '/app/';
    }

    public function userCanView($user)
    {
        if (!is_null($user)) {
            if (env('HAS_PUBLIC_OP', false)) {
                if ($this->type == 'service') {
                    return true;
                }
            }

            if ($user->role == 'admin' || $user->role == 'operator') {
                return true;
            }

            if (env('HAS_PUBLIC_OP', false) && $user->role == 'student') {
                return true;
            }
        }

        return false;
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

    public function renew()
    {
        $this->status = 'pending';
        $this->save();
    }

    public static function areas()
    {
        $current_instance = Config::getConf('instance_city');
        $ret = [];

        switch($current_instance) {
            case 'Torino':
                for ($i = 1; $i < 9; $i++) {
                    $key = sprintf('circ%d', $i);
                    $ret[$key] = sprintf('Torino / Circoscrizione %d', $i);
                }

                $ret['other'] = 'Altro';
                break;

            case 'Milano':
                for ($i = 1; $i < 9; $i++) {
                    $key = sprintf('municipio%d', $i);
                    $ret[$key] = sprintf('Milano / Municipio %d', $i);
                }

                $ret['other'] = 'Altro';
                break;

            case 'Trentino':
                $ret["COMUNITA' TERRITORIALE DELLA VAL DI FIEMME"] = "COMUNITA' TERRITORIALE DELLA VAL DI FIEMME";
                $ret["COMUNITA' DI PRIMIERO"] = "COMUNITA' DI PRIMIERO";
                $ret["COMUNITA' VALSUGANA E TESINO"] = "COMUNITA' VALSUGANA E TESINO";
                $ret["COMUNITA' ALTA VALSUGANA E BERSNTOL"] = "COMUNITA' ALTA VALSUGANA E BERSNTOL";
                $ret["COMUNITA' DELLA VALLE DI CEMBRA"] = "COMUNITA' DELLA VALLE DI CEMBRA";
                $ret["COMUNITA' DELLA VAL DI NON"] = "COMUNITA' DELLA VAL DI NON";
                $ret["COMUNITA' DELLA VALLE DI SOLE"] = "COMUNITA' DELLA VALLE DI SOLE";
                $ret["COMUNITA' DELLE GIUDICARIE"] = "COMUNITA' DELLE GIUDICARIE";
                $ret["COMUNITA' ALTO GARDA E LEDRO"] = "COMUNITA' ALTO GARDA E LEDRO";
                $ret["COMUNITA' DELLA VALLAGARINA"] = "COMUNITA' DELLA VALLAGARINA";
                $ret["COMUN GENERAL DE FASCIA"] = "COMUN GENERAL DE FASCIA";
                $ret["MAGNIFICA COMUNITA' DEGLI ALTIPIANI CIMBRI"] = "MAGNIFICA COMUNITA' DEGLI ALTIPIANI CIMBRI";
                $ret["COMUNITA' ROTALIANA - KONIGSBERG"] = "COMUNITA' ROTALIANA - KONIGSBERG";
                $ret["COMUNITA' DELLA PAGANELLA"] = "COMUNITA' DELLA PAGANELLA";
                $ret["COMUNITA' DELLA VALLE DEI LAGHI"] = "COMUNITA' DELLA VALLE DEI LAGHI";
                $ret["TRENTO"] = "TRENTO";
                $ret["ROVERETO"] = "ROVERETO";
                $ret['other'] = 'Altro';
                break;

            default:
                $ret['other'] = 'Altro';
                break;
        }

        return $ret;
    }
}
