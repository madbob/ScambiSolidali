<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Log;
use DB;

use App\RecurringPick;
use App\Notifications\RecurringNotification;

class Recurring extends Model
{
    private $obj_contents = null;

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function getLinkAttribute()
    {
        return route('periodico.create', ['token' => $this->identifier]);
    }

    public function getDataAttribute()
    {
        if (is_null($this->obj_contents))
            $this->obj_contents = json_decode($this->contents);
        return $this->obj_contents;
    }

    public function getStatusIconAttribute()
    {
        switch($this->status) {
            case 'pending':
                return 'question-sign';
            case 'ok':
                return 'ok-sign';
            case 'ko':
                return 'remove-sign';
        }

        return '?';
    }

    public function getStatusAttribute()
    {
        if ($this->filled == false) {
            return 'pending';
        }
        else {
            if ($this->data->having == true)
                return 'ok';
            else
                return 'ko';
        }

        Log::error('Stato non identificato per donazione ricorrente ' . $this->id);
        return '?';
    }

    public function scopeWeekly($query)
    {
        return $query->whereHas('company', function($subquery) {
            $subquery->where('donation_frequency', 'weekly');
        });
    }

    public function scopeMonthly($query)
    {
        return $query->whereHas('company', function($subquery) {
            $subquery->where('donation_frequency', 'monthly');
        });
    }

    private static function generateAll($companies)
    {
        foreach($companies as $c) {
            $recurring = Recurring::where('company_id', $c->id)->where('closed', false)->first();
            if (is_null($recurring)) {
                $recurring = new Recurring();
                $recurring->company_id = $c->id;
                $recurring->filled = false;
                $recurring->closed = false;

                /*
                    Attenzione: l'identificativo deve essere ragionevolmente lungo,
                    ma non troppo in quanto il link dovrà essere messo negli SMS di
                    notifica (che ovviamente hanno caratteri limitati)
                */
                do {
                    $recurring->identifier = str_random(20);
                } while(Recurring::where('identifier', $recurring->identifier)->count() != 0);

                $recurring->contents = '';
                $recurring->save();
            }

            if ($recurring->filled == false) {
                foreach($c->users as $u) {
                    try {
                        $u->notify(new RecurringNotification($recurring));
                    }
                    catch(\Exception $e) {
                        Log::error('Impossibile notificare utente ' . $u->id . ' per le disponibilità ricorrenti: ' . $e->getMessage());
                    }
                }
            }
        }
    }

    public static function generateWeekly()
    {
        $today = date('Y-m-d');
        Recurring::weekly()->where(DB::raw('DATE(created_at)'), '!=', $today)->where('closed', false)->update(['closed' => true]);

        $companies = Company::where('donation_frequency', 'weekly')->get();
        self::generateAll($companies);
    }

    public static function generateMonthly()
    {
        $today = date('Y-m-d');
        Recurring::monthly()->where(DB::raw('DATE(created_at)'), '!=', $today)->where('closed', false)->update(['closed' => true]);
        RecurringPick::where('closed', false)->update(['closed' => true]);

        $companies = Company::where('donation_frequency', 'monthly')->get();
        self::generateAll($companies);
    }

    public static function categories()
    {
        return [
            (object) [
                'label' => 'Pasta',
                'identifier' => 'pasta',
                'quantity_type' => 'numeric',
                'unit_measure' => 'Chili'
            ],
            (object) [
                'label' => 'Zucchero',
                'identifier' => 'zucchero',
                'quantity_type' => 'numeric',
                'unit_measure' => 'Chili'
            ],
            (object) [
                'label' => 'Caffé',
                'identifier' => 'caffe',
                'quantity_type' => 'numeric',
                'unit_measure' => 'Chili'
            ],
        ];
    }

    public static function categoriesLabels()
    {
        $ret = [];

        foreach(self::categories() as $c)
            $ret[$c->identifier] = $c->label;

        return $ret;
    }

    public static function printableCategoryQuantity($product, $quantity)
    {
        $cats = self::categories();

        foreach($cats as $c) {
            if ($c->identifier == $product) {
                if ($c->quantity_type == 'numeric')
                    return sprintf('%s %s', $quantity, $c->unit_measure);
            }
        }

        Log::error('Categoria donazione ricorrente non identificata: ' . $product);
        return '';
    }

    public static function buildMonthlyData()
    {
        $collective_month = [];
        foreach(self::categories() as $cat) {
            $collective_month[$cat->identifier] = (object) [
                'label' => $cat->label,
                'donated' => 0,
                'required' => 0
            ];
        }

        $monthly = Recurring::monthly()->where('closed', false)->get();
        foreach($monthly as $donation) {
            if ($donation->status == 'ok') {
                foreach($donation->data->quantities as $q) {
                    $collective_month[$q->type]->donated += $q->quantity;
                }
            }
        }

        $picks = RecurringPick::where('closed', false)->get();
        foreach($picks as $request) {
            foreach($request->data->quantities as $q) {
                $collective_month[$q->type]->required += $q->quantity;
            }
        }

        return $collective_month;
    }
}
