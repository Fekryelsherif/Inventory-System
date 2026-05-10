<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\Services\ProductionServiceInterface;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    protected $service;

    public function __construct(ProductionServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات', $this->service->index($request));
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'quantity' => 'required|numeric|min:1'
        ]);
        return apiResponse('تم الإنشاء', $this->service->store($data), 200);
    }

    public function show($id)
    {
        return apiResponse('تم جلب العنصر', $this->service->show($id), 200);
    }

    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'recipe_id' => 'sometimes|exists:recipes,id',
            'quantity' => 'sometimes|numeric|min:1'
        ]);
        return apiResponse('تم التحديث', $this->service->update($id, $data), 200);
    }

    public function destroy($id)
    {
        return apiResponse('تم الحذف', $this->service->destroy($id), 200);
    }

    public function execute($id)
    {
        return apiResponse('تم التنفيذ', $this->service->execute($id), 200);
    }
}
