<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\OrderServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $service;

    public function __construct(OrderServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'items' => 'required|array|min:1',

            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001',
            'items.*.selling_price' => 'required|numeric|min:0',
        ]);
        return apiResponse('تم إنشاء الطلب', $this->service->create($data), 201);
    }

    public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات', $this->service->index($request),200);
    }

    public function show($id)
    {
        return apiResponse('تم جلب البيانات', $this->service->show($id),200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'items' => 'required|array|min:1',

            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001',
            'items.*.selling_price' => 'required|numeric|min:0',
        ]);

        return apiResponse(
            'تم تحديث البيانات',
            $this->service->update($id, $data),
            200
        );
    }

    public function destroy($id)
    {
        return apiResponse('تم حذف البيانات', $this->service->delete($id),200);
    }
}