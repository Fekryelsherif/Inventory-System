<?php

namespace App\Contracts\Services;



interface StockCountServiceInterface {

    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getAll($request);
    public function getById($id);

    public function applyAdjustment($id);


}
