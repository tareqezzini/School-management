<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\ViewName;

class ExamController extends Controller
{
   
    public function index()
    {
        $quizzes = Quizze::where('grade_id' , auth()->user()->Grade_id)
        ->where('classroom_id', auth()->user()->Classroom_id) 
        ->where('section_id', auth()->user()->section_id)
        ->orderBy('id' , 'DESC')->get();
        return View('pages/Students/Dashboard/exams', compact('quizzes'));
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

   
    public function show($quizze_id)
    {
        $student_id = Auth::user()->id;
        return View('pages/Students/Dashboard/show' , compact('quizze_id' , 'student_id'));
    }

    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}