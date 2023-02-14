<?php 

namespace App\Repository;

interface FeesRepositoryInterface
{
    // Show Fees 
    public function index();
    // Add Fees 
    public function addFees();
    // Store Fees 
    public function storeFees($request);
    // Edit Fees
    public function edit($id);
    // Update Fees
    public function updateFees($request);
    // Delete Fees
    public function deleteFees($request);

}
