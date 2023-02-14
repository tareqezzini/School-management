<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Sections;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    public function index()
    {
        $quizzes = Quizze::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.create', $data);
    }


    public function store(Request $request)
    {
        try {
            $quizzes = new Quizze();
            $quizzes->name = $request->Name;
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('quizzes.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $quizz = Quizze::findOrFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.edit', $data, compact('quizz'));
    }


    public function update(Request $request)
    {
        try {
            $quizz = Quizze::findOrFail($request->id);
            $quizz->name = $request->Name;
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            Quizze::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quizze::findorFail($id);
        return view('pages.Teachers.Questions.index',compact('questions','quizz'));
    }

    //show Student who pass the quizzes
    public function Student_quizzes($quizzes_id)
    {
        $degrees  = Degree::where('quizze_id' , $quizzes_id)->get();
        return view('pages.Teachers.Quizzes.student_quizze' , compact('degrees'));
    }

    // Reapt the Exams

    public function repeat_quizze(Request $req)
    {
        Degree::where('student_id', $req->student_id)->where('quizze_id', $req->quizze_id)->delete();
        toastr()->success('تم فتح الاختبار مرة اخرى للطالب');
        return redirect()->back();

    }
}