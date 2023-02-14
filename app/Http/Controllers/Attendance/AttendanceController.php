<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{
    protected $attendance;
    public function __construct(AttendanceRepositoryInterface $attendance)
    {
        return $this->attendance = $attendance;
    }

    public function index()
    {
        return $this->attendance->index();
    }
   
    public function show($id)
    {
        return $this->attendance->show($id);
    }
    public function store(Request $request)
    {
        return $this->attendance->store($request);
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
