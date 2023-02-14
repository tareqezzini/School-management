<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\onlineClass;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineZoomClassesController extends Controller
{
    use MeetingZoomTrait;
    public function index()
    {
        $online_classes = onlineClass::where('created_by',auth()->user()->email)->get();
        return view('pages.Teachers.online_classes.index', compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Teachers.online_classes.add', compact('Grades'));
    }

    // public function indirectCreate()
    // {
    //     $Grades = Grade::all();
    //     return view('pages.Teachers.online_classes.indirect', compact('Grades'));
    // }



    public function store(Request $request)
    {
        try {

            $meeting = $this->createMeeting($request);

            onlineClass::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // public function storeIndirect(Request $request)
    // {
    //     try {
    //         onlineClass::create([
    //             'integration' => false,
    //             'Grade_id' => $request->Grade_id,
    //             'Classroom_id' => $request->Classroom_id,
    //             'section_id' => $request->section_id,
    //             'created_by' => auth()->user()->email,
    //             'meeting_id' => $request->meeting_id,
    //             'topic' => $request->topic,
    //             'start_at' => $request->start_time,
    //             'duration' => $request->duration,
    //             'password' => $request->password,
    //             'start_url' => $request->start_url,
    //             'join_url' => $request->join_url,
    //         ]);
    //         toastr()->success(trans('messages.success'));
    //         return redirect()->route('online_zoom_classes.index');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }

    // }


    public function destroy(Request $request,$id)
    {
        try {

            $info = onlineClass::find($id);

            if($info->integration == true){
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
                onlineClass::destroy($id);
            }
            else{

                onlineClass::destroy($id);
            }

            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}