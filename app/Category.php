<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function getIconPathAttribute()
    {
        $parent = $this->parent;
        if ($parent == null)
            $parent = $this;

        return sprintf('images/categories/%s_%s.svg', str_replace(' ', '_', strtolower($parent->name)), str_replace(' ', '_', strtolower($this->name)));
    }

    public function getIconAttribute()
    {
        return url($this->icon_path);
    }
}
