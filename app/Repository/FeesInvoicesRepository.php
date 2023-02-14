<?php

namespace App\Repository;

use App\Models\Fees;
use App\Models\FeesInvoice;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface 
{
   // Show Fess Invoices 
      public function index()
      {
         $Fee_invoices = FeesInvoice::all();
         return view('pages.Fees_Invoices.index' , compact('Fee_invoices'));
      }
     // Show Fess Invoices Add 
     public function Show($id)
     {
         $student = Student::where('id' , $id)->first();
         // return $student;
         $fees = Fees::all();
        return view('pages.Fees_Invoices.add' , compact('student' , 'fees'));
     }
     // Add Student Invoices 
    public function addInvoices($request)
    {
      $List_Fees  = $request->List_Fees;
      DB::beginTransaction();

      // try {
            foreach($List_Fees as $List_Fee)
            {
               // Add to table Fees Invoices : 
               $Fees = new FeesInvoice();
               $Fees->invoice_date = date('Y-m-d');
               $Fees->student_id = $List_Fee['student_id'];
               $Fees->Grade_id = $request->Grade_id;
               $Fees->Classroom_id = $request->Classroom_id;;
               $Fees->fee_id = $List_Fee['fee_id'];
               $Fees->amount = $List_Fee['amount'];
               $Fees->description = $List_Fee['description'];
               $Fees->save();
               // Add to table Student Account :: 
               $StudentAccount = new StudentAccount();
               $StudentAccount->student_id = $List_Fee['student_id'];
               $StudentAccount->date = date('Y-m-d');
               $StudentAccount->type = 'invoice';
               $StudentAccount->Debit = $List_Fee['amount'];
               $StudentAccount->credit = 0.00;
               $StudentAccount->description = $List_Fee['description'];
               $StudentAccount->save();
            }
            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
         // } catch (\Exception $e)
         // {
         //    DB::rollback();
         //    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         // }
    }


    //Edit Invoices
    public function editInvoices($id)
    {
      $fee_invoices = FeesInvoice::findOrFail($id);
        $fees = Fees::where('Classroom_id',$fee_invoices->Classroom_id)->get();
      return view('pages.Fees_Invoices.edit' , compact('fee_invoices' ,'fees'));
    }
     //update Student Invoices
     public function updateInvoice($request)
     {
         
         try {
            DB::beginTransaction();
            $feesInvoice = FeesInvoice::findOrFail($request->id);
            $feesInvoice->amount = $request->amount;
            $feesInvoice->description = $request->description;
            $feesInvoice->save();

            //update student Account
            $StudentAccount  = StudentAccount::where('fee_invoice_id' , $request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $feesInvoice->save();
            DB::commit();
         } catch(\Exception $e)
         {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
     }

     // Delete Invoices
    public function deleteInvoices($request)
    {
      try{
         FeesInvoice::findOrFail($request->id)->destroy();
         toastr()->success(trans('messages.Delete'));
         return redirect()->back();
      }catch(\Exception $e)
      {
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
    }
}