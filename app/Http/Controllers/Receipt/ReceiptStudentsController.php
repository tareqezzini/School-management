<?php

namespace App\Http\Controllers\Receipt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\ReceiptStudentsRepositoryInterface;
class ReceiptStudentsController extends Controller
{
    protected $receipt;
    public function __construct(ReceiptStudentsRepositoryInterface $receipt)
    {
        $this->receipt = $receipt;
    }
  
    public function index()
    {
        return $this->receipt->index();
    }

    
    public function create(Request $request)
    {
    }

   
    public function store(Request $request)
    {
        return $this->receipt->add($request);
    }

   
    public function show($id)
    {
        return $this->receipt->show($id);
    }

    public function edit($id)
    {
       return $this->receipt->edit($id);
    }

    public function update(Request $request)
    {
        return $this->receipt->update($request);
    }

  
    public function destroy(Request $request)
    {
        return $this->receipt->destroy($request);
    }
}
