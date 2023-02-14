<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class receiptStudent extends Model
{
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student' , 'student_id');
    }
}