<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Product extends Model
{
    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->attributes['image']);
    }
}
