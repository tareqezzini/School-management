<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];
    

    // relationship between student and Promotion
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    // relationship between f_grade and Promotion

    public function f_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'from_grade');
    }


    // relationship between f_classroom and Promotion

    public function f_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'from_Classroom');
    }

    // relationship between f_section and Promotion

    public function f_section()
    {
        return $this->belongsTo('App\Models\Sections', 'from_section');
    }

    // relationship between to_grade and Promotion

    public function t_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade');
    }


    // relationship between to_Classroom and Promotion

    public function t_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'to_Classroom');
    }

    // relationship between to_section and Promotion

    public function t_section()
    {
        return $this->belongsTo('App\Models\Sections', 'to_section');
    }
}