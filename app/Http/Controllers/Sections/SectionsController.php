<?php

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Sections;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr As toastr;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_Grades = Grade::all();
        $teachers = Teachers::all();
        $Grades = Grade::with(['Sections'])->get();
        return view('pages.Sections.Sections', compact('Grades' , 'list_Grades','teachers') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            $sections = new Sections();
            $sections->Name_Section = $request->Name_Section;
            $sections->Status = 0;
            $sections->Grade_id = $request->Grade_id;
            $sections->Class_id = $request->Class_id;
            $sections->save();

            $sections->teachers()->attach($request->teacher_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('Sections.index');
        }catch (\Exception $e) 
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
            
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sections $sections)
    {
       
        try {
            $sections = Sections::findOrFail($request->id);
            $sections->Name_Section = $request->Name_Section;
            $sections->Grade_id = $request->Grade_id;
            $sections->Class_id = $request->Class_id;
            isset($request->Status) ?  $sections->Status = 1 : $sections->Status = 0;
            if(isset($request->teacher_id))
            {
                $sections->teachers()->sync($request->teacher_id);
            }else
            {
                $sections->teachers()->sync([]);

            }
            $sections->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sections = Sections::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
          return redirect()->route('Sections.index');
    }

    public function getClasses($id)
    {
        $list_classes = Classroom::where('Grade_id' , $id)->pluck('Name_Class' ,'id');

        return $list_classes;
    }
}
