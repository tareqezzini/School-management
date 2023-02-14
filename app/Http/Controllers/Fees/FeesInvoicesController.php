<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\FeesInvoicesRepositoryInterface;
class FeesInvoicesController extends Controller
{
    protected $feesInvoices;
    public function __construct(FeesInvoicesRepositoryInterface $feesInvoices)
    {
        return $this->feesInvoices = $feesInvoices;
    }

    public function index()
    {
        return $this->feesInvoices->index();
    }
    

    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        return $this->feesInvoices->addInvoices($request);
    }
    
   
    public function show($id)
    {
        return $this->feesInvoices->Show($id);
    }

    public function edit($id)
    {
        return $this->feesInvoices->editInvoices($id);
    }

 
    public function update(Request $request)
    {
        return $this->feesInvoices->updateInvoice($request);
    }

    public function destroy(Request $request)
    {
        return $this->feesInvoices->deleteInvoices($request);
    }
}
