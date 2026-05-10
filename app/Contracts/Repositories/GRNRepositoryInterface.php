<?php

namespace App\Contracts\Repositories;
Interface GRNRepositoryInterface{
    public function show($id);
    public function index();
    public function update($id, $data);
    public function delete($id);
}
