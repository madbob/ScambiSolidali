<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function picturePath($local)
    {
        $path = '/media/' . $this->id;
        if ($local)
            $path = public_path() . $path;

        return $path;
    }

    public function getPictureAttribute()
    {
        $path = $this->picturePath(true);
        if (file_exists($path))
            return $this->picturePath(false);
        else
            return null;
    }
}
