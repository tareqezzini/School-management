<?php 

namespace App\Repository;

interface FeesInvoicesRepositoryInterface 
{
    // Show Fess Invoices 
    public function index();

    // Show Fess Invoices Add 
    public function Show($id);
    // Add Student Invoices
    public function addInvoices($request);

    //Edit Student Invoices
    public function editInvoices($id);
    //update Student Invoices
    public function updateInvoice($request);
    // Delete Invoices
    public function deleteInvoices($id);
    
}