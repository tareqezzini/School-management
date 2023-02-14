<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teachers;
use Illuminate\Support\Facades\Hash;

class TeachersRepository implements TeachersRepositoryInterface{
    // Get All Teachers 
    public function getAllTeachers()
    {
        return Teachers::all();
    }
    // Get All Genders 
    public function getGender()
    {
        return  Gender::all();
    }
    // Get All Specialization
    public function getSpecialization()
    {
        
        return Specialization::all();
    }

    public function storeTeachers($req)
    {
        try {
            $Teacher = new Teachers();
            $Teacher->email = $req->Email;
            $Teacher->Specialization_id	 = $req->Specialization_id;
            $Teacher->password = Hash::make($req->Password);
            $Teacher->name = $req->Name;
            $Teacher->Gender_id = $req->Gender_id;
            $Teacher->Joining_Date = $req->Joining_Date;
            $Teacher->Address = $req->Address;
            $Teacher->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Teachers.create');
        }catch(\Exception $e)
        {
                return redirect()->back()->with(['error' =>$e->getMessage()]);
        }
    }
    // get teacher ----- Teacher Edit ----
    public function getTeacher($id)
    {
        return Teachers::findOrFail($id);
    }
    // Update Teacher 
    public function updateTeacher($req)
    {
        try {
            $Teacher =Teachers::where('id' , $req->id)->first();
            $Teacher->email = $req->Email;
            $Teacher->Specialization_id	 = $req->Specialization_id;
            $Teacher->password = Hash::make($req->Password);
            $Teacher->name = $req->Name;
            $Teacher->Gender_id = $req->Gender_id;
            $Teacher->Joining_Date = $req->Joining_Date;
            $Teacher->Address = $req->Address;
            $Teacher->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Teachers.index');
        }catch(\Exception $e)
        {
                return redirect()->back()->with(['error' =>$e->getMessage()]);
        }
    }

    // Delete Teacher
    public function deleteTeacher($req)
    {
        Teachers::where('id' ,  $req->id)->delete();
        toastr()->error(trans('message.Delete'));
        return redirect()->route('Teachers.index');
    }
    
}
?>