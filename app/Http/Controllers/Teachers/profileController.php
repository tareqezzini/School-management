<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function index()
    {
        $information = Teachers::findOrFail(auth()->user()->id);
        return view('pages/Teachers/profile' , compact('information'));
    }

    public function update(Request $request , $id)
    {
        $teacher = Teachers::findOrFail($id);
        $passwordOld =  Hash::make($request->password_old);
        return $teacher->password . '<br> ' . $passwordOld;

        if(!empty($request->password_new))
        {
            if($teacher->password === $passwordOld)
            {
                $teacher->name = $request->Name;
                $teacher->password = Hash::make($request->password);
                $teacher->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->back();
            }else{
                toastr()->error('The Password Not Correct');
                return redirect()->back();
            }
        }else{
            if($teacher->password === $passwordOld)
            {
                $teacher->name = $request->Name;
                $teacher->save();
                toastr()->success(trans('messages.Update'));
                return redirect()->back();
            }else{
                toastr()->error('The Password Not Correct');
                return redirect()->back();

            }
        }

    }
}