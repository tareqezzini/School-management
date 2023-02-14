<?php 

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionsRepository implements PromotionsRepositoryInterface
{
    //show promotions
    public function index()
    {
        $Grades = Grade::all();
    
        return view('pages.Students.Promotion.index' ,compact('Grades'));
    }
    // Show Promotion Table
     public function create()
    {
        $promotions = Promotion::all();
        return view('pages.Students.promotion.management',compact('promotions'));
    }
    //Promotion of Students
    public function store($request)
    {
        DB::beginTransaction();
        
        try {

            $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',   $request->Classroom_id)->where('section_id',$request->section_id)->get();
            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student){

                // $ids = explode(',',$student->id);
                Student::where('id', $student->id)->update(
                    [
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                    ]);

                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new
                ]);

            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    //Back all Promotions
    public function backPromotions($request)
    {
        
       if($request->page_id == 1)
       {
         DB::beginTransaction();
         $promotions =  Promotion::all();
         foreach($promotions as $promotion)
         {
            Student::where('id' , $promotion->student_id)->update(
            [
                'Grade_id' => $promotion->from_grade,
                'Classroom_id' =>$promotion->from_Classroom,
                'section_id'    =>$promotion->from_section
            ]);
         }
         Promotion::truncate();
         DB::commit();
         toastr()->error('message.Delete');
         return redirect()->back();

       }else{

         DB::beginTransaction();
        $promotion = Promotion::findOrFail($request->id);
        $id = $promotion->student_id;
        Student::where('id' ,  $id)->update(
            [
                'Grade_id'      => $promotion->from_grade,
                'Classroom_id'  => $promotion->from_Classroom,
                'section_id'    => $promotion->from_section
            ]);

         Promotion::destroy($request->id);
         DB::commit();

         toastr()->error('message.Delete');
         return redirect()->back();
       }
    }
}