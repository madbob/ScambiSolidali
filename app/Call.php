<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Vite;

class Call extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function getImageAttribute()
    {
        if ($this->status == 'archived') {
            $donations = $this->donations;
            if ($donations->isEmpty())
                return null;

            $donation = $donations->first();
            return $donation->imageUrl(1);
        }
        else {
            if ($this->category && file_exists(resource_path($this->category->icon_path))) {
                return $this->category->icon;
            }
            else {
                if ($this->type == 'service') {
                    return Vite::asset('resources/images/tempo.svg');
                }
                else {
                    return null;
                }
            }
        }
    }
}
