<?php

use PhpParser\NameContext;

namespace App\Repository;

interface SubjectsRepositoryInterface
{
    public function index();
    public function create();
    public function add($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);
}