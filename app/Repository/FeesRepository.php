<?php 

namespace App\Repository;

use App\Models\Fees;
use App\Models\Grade;
use Flasher\Laravel\Http\Request;

class FeesRepository implements FeesRepositoryInterface 
{
    
    // Show Fees 
    public function index()
    {
        $fees = Fees::all();
        return view('pages.Students.Fees.index' , compact('fees'));
    }

    // Add Fees 
    public function addFees()
    {
        $Grades = Grade::all();
        return view('pages.Students.Fees.add' , compact('Grades'));
    }
     // Store Fees 
     public function storeFees($request)
     {
        $fees = new Fees();
        $fees->title = $request->title ;
        $fees->Fee_type = $request->Fee_type;
        $fees->Grade_id = $request->Grade_id ;
        $fees->Classroom_id = $request->Classroom_id ;
        $fees->year = $request->year ;
        $fees->amount = $request->amount ;
        $fees->description = $request->description ;
        $fees->save();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
     }
     //Edit Fees
    public function edit($id)
    {
        $Grades = Grade::all();
        $fee = Fees::where('id' , $id)->first();
        return view('pages.Students.Fees.edit' , compact('fee','Grades')); 
    }
    // Update Fees
    public function updateFees($request)
    {
        try {
            $fee = Fees::findOrFail($request->id);
            $fee->title = $request->title;
            $fee->Fee_type = $request->Fee_type;
            $fee->amount = $request->amount;
            $fee->Grade_id = $request->Grade_id;
            $fee->Classroom_id = $request->Classroom_id;
            $fee->year = $request->year;
            $fee->description = $request->description;
            $fee->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // Delete Fees
    public function deleteFees($request)
    {
        try {
                $fee  = Fees::where('id' , $request->id)->first();
                $fee->delete();

                toastr()->success(trans('messages.Delete'));
                return redirect()->route('Fees.index');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
}