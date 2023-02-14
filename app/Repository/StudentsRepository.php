<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\Sections;
use App\Models\Student;
use App\Models\TypeBlood;
use App\Repository\StudentsRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class StudentsRepository implements StudentsRepositoryInterface {
     // Show Students 
     public function showStudents()
     {
        $students  = Student::all();
        return view('pages.Students.index' , compact('students'));
     }
    // Show Form Students
    public function showForm()
    {
        $data['grades'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = TypeBlood::all();
        return view('pages.Students.add' , $data);
    }

    //Get The Class Rooms
    public function getClasses($id)
    {
         $list_classes =  Classroom::where('Grade_id' , $id)->pluck('Name_Class' , 'id');
            return $list_classes;
    }
    //Get The Sections
    public function Get_Sections($id)
    {
        return  Sections::where('Class_id' , $id)->pluck('Name_Section' , 'id');
            
    }
    // Add New Student
    public function addNewStudent($request)
    {
        try {
            $students = new Student();
            $students->name = $request->name;
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            //Add the files
            if($request->hasfile('photos'))
            {
               foreach($request->file('photos') as $file)
               {
                $name = $file->getClientOriginalName();
                
                $file->storeAs('/Attachments/Students/'.$students->name , $file->getClientOriginalName() ,'attachments');
                
                $image = new Image();
                $image->filenaem = $name;
                $image->imageable_id = $students->id;
                $image->imageable_type = 'App\Models\Student';
                $image->save();
               }
            }


            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.create');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // Edit Student
    public function editStudent($id)
    {
        $Students  = Student::findOrFail($id);
        $data['Grades'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = TypeBlood::all();
        return view('pages.Students.edit' , $data , compact('Students'));
    }
     // Update Student
     public function updateStudent($request)
     {
        try {
            $Edit_Students = Student::findOrFail($request->id);

            $Edit_Students->name =  $request->name;
            $Edit_Students->email = $request->email;
            $Edit_Students->password = Hash::make($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
     }

     // Delete Student
    public function deleteStudent($request)
    {
        Student::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

    // Show Students Info
    public function showAttachments($id)
    {
        $Student  = Student::findOrFail($id);
        return view('pages.Students.show' , compact('Student') );
    }

    // Add Attachments
    public function add_attachments($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            
            $file->storeAs('Attachments/Students/'.$request->student_name , $file->getClientOriginalName() ,'attachments');
            
            $image = new Image();
            $image->filenaem = $name;
            $image->imageable_id = $request->student_id;
            $image->imageable_type = 'App\Models\Student';
            $image->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.show' ,$request->student_id);
    }

    // Download Attachments
    public function Download_attachment($attachment_name , $filename)
    {
        return response()->download(public_path('attachments/students/'.$attachment_name.'/'.$filename));
    }
    // Delete Attachment
    public function Delete_attachment($request)
    {
        Storage::disk('attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);
       Image::where('id' , $request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }

}