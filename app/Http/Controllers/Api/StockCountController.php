<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\StockCountServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockCountController extends Controller
{
    protected $service;

    public function __construct(StockCountServiceInterface $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات بنجاح', $this->service->getAll($request));
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.actual_quantity' => 'required|numeric|min:0'
        ]);

        return apiResponse('تم انشاء جرد بنجاح', $this->service->create($data));
    }

    public function show($id)
    {
        return apiResponse('تم جلب البيانات', $this->service->getById($id));
    }


    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'items' => 'sometimes|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.actual_quantity' => 'required|numeric|min:0'
        ]);
        return apiResponse('تم تحديث بيانات الجرد بنجاح', $this->service->update($id, $request));
    }

    public function destroy($id)
    {
        return apiResponse('تم حذف الجرد', $this->service->delete($id));
    }

    public function apply($id)
    {
        return apiResponse('تم التطبيق', $this->service->applyAdjustment($id));
    }
}
