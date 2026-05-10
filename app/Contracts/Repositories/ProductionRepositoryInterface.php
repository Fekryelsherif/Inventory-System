<?php

namespace App\Contracts\Repositories;


Interface ProductionRepositoryInterface
{
    public function create($data);
    public function show($id);
    public function index($request);
    public function update($id, $data);
    public function delete($id);

}
