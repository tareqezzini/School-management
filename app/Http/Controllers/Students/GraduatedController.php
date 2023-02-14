<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Repository\GraduatedRepositoryInterface;

class GraduatedController extends Controller
{
    protected $graduate;
    public function __construct(GraduatedRepositoryInterface $graduate)
    {
        return $this->graduate = $graduate;
    }

    public function index()
    {
        return $this->graduate->index();
    }

    
    public function create(Request $request)
    {
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create', compact('Grades'));
    }

    
    public function store(Request $request)
    {
        return $this->graduate->softDelete($request);
    }
    public function update(Request $request)
    {
        return $this->graduate->update($request);
    }

    public function destroy(Request $request)
    {
        Student::onlyTrashed()->where('id' , $request->id)->first()->forceDelete();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
}