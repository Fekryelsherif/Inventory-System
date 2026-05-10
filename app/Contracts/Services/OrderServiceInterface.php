<?php

namespace App\Contracts\Services;


Interface OrderServiceInterface{

   public function create(array$data);
   public function update($id,$data);
   public function delete($id);
   public function index();
   public function show($id);
}