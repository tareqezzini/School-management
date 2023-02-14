<?php 

namespace App\Repository;

interface PromotionsRepositoryInterface{


    //show promotions
    public function index();
    //Promotion of Students
    public function store($request);
    // Show Promotion Table
    public function create();
    //Back all Promotions
    public function backPromotions($request);
}