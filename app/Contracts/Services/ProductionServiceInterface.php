<?php

namespace App\Contracts\Services;

Interface ProductionServiceInterface {
    public function index($request);
    public function show($id);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);
    public function execute(int $id);
}