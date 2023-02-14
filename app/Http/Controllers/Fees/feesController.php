<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\FeesRepositoryInterface;

class feesController extends Controller
{
    protected $fees;
    public function __construct(FeesRepositoryInterface $fees)
    {
        $this->fees = $fees;
    }


    public function index()
    {
       return $this->fees->index();
    }

    
    public function create()
    {
        return $this->fees->addFees();
    }

   
    public function store(Request $request)
    {
        return $this->fees->storeFees($request);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        return $this->fees->edit($id);
    }

   
    public function update(Request $request)
    {
        return $this->fees->updateFees($request);
    }

   
    public function destroy(Request $request)
    {
       return $this->fees->deleteFees($request);
    }
}
