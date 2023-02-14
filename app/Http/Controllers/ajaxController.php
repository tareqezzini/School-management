<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Sections;

class ajaxController extends Controller
{
    //get ClassRoom
    public function getClassrooms($id)
    {
        return Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
    }

    //Get Sections
    public function Get_Sections($id){

        return Sections::where("Class_id", $id)->pluck("Name_Section", "id");
    }
}