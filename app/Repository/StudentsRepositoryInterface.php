<?php

namespace App\Repository;

interface StudentsRepositoryInterface {
    // Show Students 
    public function showStudents();
    // Show Form Students
    public function showForm();
    //Get The Class Rooms
    public function getClasses($id);
    //Get The Sections
    public function Get_Sections($id);
    //Add New Students
    public function addNewStudent($request);
    // Edit Student
    public function editStudent($id);
    // Update Student
    public function updateStudent($request);
    // Delete Student
    public function deleteStudent($request);
    // Show Students Info
    public function showAttachments($id);
    // Add Attachments
    public function add_attachments($id);
    // Download Attachments
    public function Download_attachment($attachment_name , $filename);
    // Delete Attachment
    public function Delete_attachment($request);
}