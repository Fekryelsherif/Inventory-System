<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\WasteServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WasteController extends Controller
{
    protected $service;

    public function __construct(WasteServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات', $this->service->getAll($request));
    }


    public function store(Request $request)
    {
        $data=$request->validate([
            'reason' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001'
        ]);
        return apiResponse('تم تسجيل البيانات', $this->service->create($data));
    }


    public function show($id)
    {
        return apiResponse('تم عرض البيانات', $this->service->getById($id));
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'reason' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001'
        ]);
        return apiResponse('تم تحديث البيانات', $this->service->update($id, $data));
    }

    public function destroy($id)
    {
        return apiResponse('تم الحذف', $this->service->delete($id));
    }
}