<?php

namespace App\Contracts\Repositories;
interface PurchaseRepositoryInterface{

    public function create($data);
    public function show($id);
    public function index();
    public function update($id, $data);
    public function delete($id);

}
