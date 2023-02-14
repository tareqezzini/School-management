<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'Classrooms';
    public $timestamps = true;
    protected $fillable=['Name_Class','Grade_id'];



    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

}