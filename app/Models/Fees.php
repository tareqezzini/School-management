<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
   protected $guarded = [];


   public function grade()
   {
        return $this->belongsTo('App\Models\Grade' , 'Grade_id');
   }
   public function classroom()
   {
        return $this->belongsTo('App\Models\Classroom' , 'Classroom_id');
   }
}
