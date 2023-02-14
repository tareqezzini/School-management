<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Student::findOrFail(auth()->user()->id);
        return view('pages/Students/Dashboard/profile' , compact('information'));

    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $passwordOld =  Hash::make($request->password_old);
        return $student->password . '<br> ' . $passwordOld;

        if(!empty($request->password_new))
        {
            if($student->password === $passwordOld)
            {
                $student->name = $request->Name;
                $student->password = Hash::make($request->password);
                $student->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->back();
            }else{
                toastr()->error('The Password Not Correct');
                return redirect()->back();
            }
        }else{
            if($student->password === $passwordOld)
            {
                $student->name = $request->Name;
                $student->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->back();
            }else{
                toastr()->error('The Password Not Correct');
                return redirect()->back();

            }
        }

    }
   

    public function destroy($id)
    {
        //
    }
}