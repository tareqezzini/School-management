<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    
    // protected $table = 'Classrooms';
    public $timestamps = true;
    protected $fillable = ['Name_Section','Status','Grade_id','Class_id'];

    public function My_class()
    {
        return $this->belongsTo('App\Models\Classroom' ,'Class_id');
    }
    
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teachers' , 'sections_teachers');
    }
    public function grades()
    {
        return $this->belongsTo('App\Models\Grade' , 'Grade_id');
    }
}