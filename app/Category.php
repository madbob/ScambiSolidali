<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Vite;

class Category extends Model
{
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sorting', 'asc')->orderBy('name', 'asc');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getIconPathAttribute()
    {
        $parent = $this->parent;
        if ($parent == null) {
            $parent = $this;
        }

        return sprintf('images/categories/%s_%s.svg', str_replace(' ', '_', strtolower($parent->name)), str_replace(' ', '_', strtolower($this->name)));
    }

    public function getIconAttribute()
    {
        return Vite::asset('resources/' . $this->icon_path);
    }
}
