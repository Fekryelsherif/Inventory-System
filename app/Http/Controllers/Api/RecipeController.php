<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\RecipeServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    protected $service;

    public function __construct(RecipeServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات', $this->service->getAll($request), 200);
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'output_item_id' => 'required|exists:items,id',
            'output_quantity' => 'required|numeric|min:0.001',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001'
        ]);
        return apiResponse('تم الإنشاء', $this->service->create($data), 201);
    }

    public function show($id)
    {
        return apiResponse('تم جلب العنصر', $this->service->getById($id), 200);
    }

    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'output_item_id' => 'sometimes|exists:items,id',
            'output_quantity' => 'sometimes|numeric|min:0.001',
            'items' => 'sometimes|array|min:1',
            'items.*.item_id' => 'required_with:items|exists:items,id',
            'items.*.quantity' => 'required_with:items|numeric|min:0.001'
        ]);
        return apiResponse('تم التحديث', $this->service->update($id, $data), 200);
    }

    public function destroy($id)
    {
        return apiResponse('تم الحذف', $this->service->delete($id), 200);
    }
}
