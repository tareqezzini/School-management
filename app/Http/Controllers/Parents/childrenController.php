<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\FeesInvoice;
use App\Models\MyParent;
use App\Models\receiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class childrenController extends Controller
{
    public function index()
    {
        $students  = Student::where('id' , auth()->user()->id)->get();
        return view('pages.Parents.children' , compact('students'));
    }
    public function results($student_id)
    {
        $student = Student::findOrFail($student_id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error('يوجد خطا في كود الطالب');
            return redirect()->route('children');
        }else
        {
            $degrees = Degree::where('student_id', $student_id)->get();
            if ($degrees->isEmpty()) {
                toastr()->error('لا توجد نتائج لهذا الطالب');
                return redirect()->route('children');
            }else
            {
                return view('pages.Parents.degree', compact('degrees'));
            }
        }
    }

    public function attendance()
    {
        $students = Student::where('parent_id' , auth()->user()->id)->get();
        return view('pages.Parents.attendance' , compact('students'));
    }


    public function attendanceSearch(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        $ids = DB::table('sections_teachers')->where('teachers_id', auth()->user()->id)->pluck('sections_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.Parents.attendance', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.Parents.attendance', compact('Students', 'students'));

        }

    }

    //Get the Fees 
    public function getFees()
    {
        $students_id = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = FeesInvoice::whereIn('student_id', $students_id)->get();
        return view('pages.Parents.fees' , compact('Fee_invoices'));
        return $Fee_invoices;
    }
    //Get The Receipt
    public function getReceipt($id)
    {
        $student = Student::findOrFail($id);
        if($student->parent_id == auth()->user()->id)
        {
            $receipt_students  = receiptStudent::where('student_id' , $id)->get();
            if(!empty($receipt_students ))
            {
                return view('pages.Parents.receipt' , compact('receipt_students'));
            }else
            {
                toastr()->error('لاتوجد مذفوعات ');
                return redirect()->route('children');
            }
        }else{
            toastr()->error('لا توجد نتائج لهذا الطالب');
            return redirect()->route('children');
        }
    }

    public function getProfile()
    {
       $information = MyParent::findOrFail(auth()->user()->id);
       return view('pages.Parents.profile' , compact('information'));
    }
    // Update Profile of parents
    public function updateProfile(Request $request , $id)
    {
       
        $parent = MyParent::findOrFail($id);
        $passwordOld =  Hash::make($request->password_old);

        if(!empty($request->password_new))
        {
            if($parent->password === $passwordOld)
            {
                $parent->name = $request->Name;
                $parent->password = Hash::make($request->password);
                $parent->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->back();
            }else{
                toastr()->error('The Password Not Correct');
                return redirect()->back();
            }
        }else{
            if($parent->password === $passwordOld)
            {
                $parent->name = $request->Name;
                $parent->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->back();
            }else{
                toastr()->error('The Password Not Correct');
                return redirect()->back();

            }
        }
    }


}