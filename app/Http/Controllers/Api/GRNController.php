<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\GRNServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GRNController extends Controller
{
     protected $service;

    public function __construct(GRNServiceInterface $service)
    {
        $this->service = $service;
    }


     public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات', $this->service->index($request), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',

            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.received_quantity' => 'required|numeric|min:0.001',
        ]);

    return apiResponse(
        'تم استلام البضاعة',
        $this->service->create($data),201);
    }

    public function show($id)
    {
        return apiResponse('تم جلب البيانات', $this->service->show($id), 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'purchase_order_id' => 'sometimes|exists:purchase_orders,id',

            'items' => 'sometimes|array|min:1',
            'items.*.item_id' => 'required_with:items|exists:items,id',
            'items.*.received_quantity' => 'required_with:items|numeric|min:0.001',
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
