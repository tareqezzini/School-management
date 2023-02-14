<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\QuizzesRepositoryInterface;

class QuizzesController extends Controller
{
    protected $Quizzes;

    public function __construct(QuizzesRepositoryInterface $Quizzes)
    {
        $this->Quizzes =$Quizzes;
    }

    public function index()
    {
        return $this->Quizzes->index();
    }

    public function create()
    {
        return $this->Quizzes->create();
    }


    public function store(Request $request)
    {
        return $this->Quizzes->store($request);
    }

    public function edit($id)
    {
        return $this->Quizzes->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Quizzes->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Quizzes->destroy($request);
    }
}
