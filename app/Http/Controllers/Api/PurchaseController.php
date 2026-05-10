<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\PurchaseServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    protected $service;

    public function __construct(PurchaseServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'sometimes|in:pending,approved,cancelled',

            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001',
            'items.*.price' => 'nullable|numeric|min:0',
       ]);

        return apiResponse(
            'تم إنشاء أمر الشراء',
            $this->service->create($data),201);
    }
    public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات', $this->service->index($request), 200);
    }

    public function show($id)
    {
        return apiResponse('تم جلب البيانات', $this->service->show($id), 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'status' => 'sometimes|in:pending,approved,cancelled',

            'items' => 'sometimes|array|min:1',
            'items.*.item_id' => 'required_with:items|exists:items,id',
            'items.*.quantity' => 'required_with:items|numeric|min:0.001',
            'items.*.price' => 'nullable|numeric|min:0',
       ]);

        return apiResponse(
            'تم التحديث',
            $this->service->update($id, $data),
            200
        );
    }

    public function destroy($id)
    {
        return apiResponse('تم الحذف', $this->service->delete($id), 200);
    }


}