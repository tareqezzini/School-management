<?php

namespace App\Repository;

interface GraduatedRepositoryInterface
{
    //    Get Graduate Table
    public function index();
    //   Return the Student
    public function update($request);
    // Add Graduate 
    public function softDelete($request);
    // Delete Student
    public function destroy($request);
    
}
