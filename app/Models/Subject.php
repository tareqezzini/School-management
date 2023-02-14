<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded =[];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade' , 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom' , 'classroom_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers' , 'teacher_id');
    }
}
