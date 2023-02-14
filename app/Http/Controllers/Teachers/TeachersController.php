<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Models\Teachers;
use App\Repository\TeachersRepositoryInterface;
use Illuminate\Http\Request;


class TeachersController extends Controller
{
   
    protected $Teacher;

    public function __construct(TeachersRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers' , compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders  = $this->Teacher->getGender();
        $specializations = $this->Teacher->getSpecialization();
        return view('pages.Teachers.TeachersForm' , compact('genders' , 'specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeachers $request)
    {
        return $this->Teacher->storeTeachers($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function show(Teachers $teachers)
    {
        $genders  = $this->Teacher->getGender();
        $specializations = $this->Teacher->getSpecialization();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Teachers = $this->Teacher->getTeacher($id);
        // return $Teacher;
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGender();
        return view('pages.Teachers.TeachersEdit' , compact('Teachers' ,'genders' ,'specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->Teacher->updateTeacher($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        return $this->Teacher->deleteTeacher($req);
    }
}
