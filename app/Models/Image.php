<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fileable = ['filename' , 'imageable_id' , 'imageable_type'];
    public function imageable()
    {
        return $this->morphTo();
    }
}
