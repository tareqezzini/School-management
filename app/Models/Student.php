<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use SoftDeletes;
    protected  $guarder = [];
    //relationship between students and Gender
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender' , 'gender_id');
    }
    //relationship between students and Grade
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade' , 'Grade_id');
    }

    //relationship between students and Classroom
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom' , 'Classroom_id');
    }
    //relationship between students and Section
    public function section()
    {
        return $this->belongsTo('App\Models\Sections' , 'section_id');
    }
    
    // relationship between students and Nationality
    public function Nationality()
    {
        return $this->belongsTo('App\Models\Nationalitie' , 'nationalitie_id');
    }
    // relationship between students and Parents
    public function myparent()
    {
        return $this->belongsTo('App\Models\MyParent' , 'parent_id');
    }
    // relationship between students and Images
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');

    }
    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance', 'student_id');
    }
}