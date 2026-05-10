<?php

namespace App\Contracts\Services;


Interface GRNServiceInterface
{
    public function create($data);
    public function show($id);
    public function index();
    public function update($id, $data);
     public function delete($id);
}
