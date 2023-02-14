<?php

namespace App\Repository;

interface TeachersRepositoryInterface{
    // get all teachers: 
    public function getAllTeachers();
    // get all Specialization 
    public function getSpecialization();
    // get all Gender 
    public function getGender();
    // store Teachers
    public function storeTeachers($req);
    // edit Teacher
    public function getTeacher($id);
    // Update Teacher
    public function updateTeacher($req);
    // Delete Teacher
    public function deleteTeacher($req);
}
