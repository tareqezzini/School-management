<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\SubjectsRepositoryInterface;
class SubjectController extends Controller
{
    protected $subject;
    public function __construct(SubjectsRepositoryInterface $subject)
    {
        return $this->subject = $subject;
    }
    public function index()
    {
        return $this->subject->index();
    }

    public function store(Request $request)
    {
        return $this->subject->add($request);
    }

   
    public function create()
    {
        return $this->subject->create();
    }

   
    public function edit($id)
    {
        return $this->subject->edit($id);
    }

   
    public function update(Request $request)
    {
        return $this->subject->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->subject->destroy($request);
    }
}
