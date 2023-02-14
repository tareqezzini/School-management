<?php

namespace App\Repository;

use App\Http\Controllers\Students\StudentController;
use App\Models\Student;

class GraduatedRepository implements GraduatedRepositoryInterface
{
//    Get Graduate Table
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index' , compact('students'));
    }
//   Return the Student
    public function update($request)
    {
        // return $request;
        $student = Student::onlyTrashed()->where('id' , $request->id)->first()->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
    // Add Graduate 
    public function softDelete($request)
    {
        $students = Student::where('Grade_id' , $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id' , $request->section_id)->get();
        if($students->count() < 1)
        {
            return redirect()->back()->with('error_Graduated','No Students');
        }else
        {
            foreach($students as $student)
            {
                $student->Delete();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
    }

    // Delete Student
    public function destroy($request)
    {
        return $request;
    }
}
?>