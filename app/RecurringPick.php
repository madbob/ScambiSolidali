<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecurringPick extends Model
{
    private $obj_contents = null;

    public function institute()
    {
        return $this->belongsTo('App\Institute');
    }

    public function getDataAttribute()
    {
        if (is_null($this->obj_contents))
            $this->obj_contents = json_decode($this->contents);
        return $this->obj_contents;
    }

    public function getQuantity($product)
    {
        $data = $this->data;
        foreach($data->quantities as $q) {
            if ($q->type == $product)
                return $q->quantity;
        }

        return 0;
    }
}
