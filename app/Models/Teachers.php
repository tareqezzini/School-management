<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teachers extends Authenticatable
{
    protected $guarded=[];

    public function specialization()
    {
       return $this->belongsTo('App\Models\Specialization' , 'Specialization_id');
    }
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender' , 'Gender_id');
    }
    public function sections()
    {
        return $this->belongsToMany('App\Models\Sections', 'sections_teachers');
    }
}