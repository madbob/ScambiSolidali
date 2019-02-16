<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Log;

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
            $recurring = new Recurring();
            $recurring->company_id = $c->id;
            $recurring->filled = false;
            $recurring->closed = false;
            $recurring->identifier = str_random(50);
            $recurring->contents = '';
            $recurring->save();
        }
    }

    public static function generateWeekly()
    {
        $companies = Company::where('donation_frequency', 'weekly')->get();
        self::generateAll($companies);
    }

    public static function generateMonthly()
    {
        $companies = Company::where('donation_frequency', 'monthly')->get();
        self::generateAll($companies);
    }

    public static function categories()
    {
        return [
            (object) [
                'label' => 'Pasta',
                'quantity_type' => 'numeric',
                'unit_measure' => 'Chili'
            ],
            (object) [
                'label' => 'Zucchero',
                'quantity_type' => 'numeric',
                'unit_measure' => 'Chili'
            ],
            (object) [
                'label' => 'Caffé',
                'quantity_type' => 'numeric',
                'unit_measure' => 'Chili'
            ],
        ];
    }

    public static function printableCategoryQuantity($product, $quantity)
    {
        $cats = self::categories();

        foreach($cats as $c) {
            if ($c->label == $product) {
                if ($c->numeric)
                    return sprintf('%s %s', $quantity, $c->unit_measure);
            }
        }

        Log::error('Categoria donazione ricorrente non identificata: ' . $product);
        return '';
    }
}
