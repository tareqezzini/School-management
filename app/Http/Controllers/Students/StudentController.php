<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentsRequest;
use App\Repository\StudentsRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentsRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->Student->showStudents();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->Student->showForm();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->Student->addNewStudent($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->Student->showAttachments($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->Student->editStudent($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->Student->updateStudent($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Student->deleteStudent($request);
    }

    
    // Add Attachments to Students

    public function Upload_attachment(Request $request)
    {
        return $this->Student->add_attachments($request);
    }
    // Download Attachment
    public function Download_attachment($attachment_name , $filename)
    {
        return $this->Student->Download_attachment($attachment_name , $filename);
    }
    // Delete Attachment
    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);
    }
}