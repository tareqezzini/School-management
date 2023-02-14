<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\AttachFilesTrait;

class SettingsController extends Controller
{
    use AttachFilesTrait;
    public function index()
    {

        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.Settings.index', $setting);
    }

    public function update(Request $request){

        try{
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

           $key = array_keys($info);
           $value = array_values($info);
           for($i =0; $i<count($info);$i++){
               Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
           }


            toastr()->success(trans('messages.Update'));
            return back();
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}