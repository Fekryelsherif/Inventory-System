<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\SupplierServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $service;

    public function __construct(SupplierServiceInterface $service)
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
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string',
            'address' => 'nullable|string',
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
            'fname' => 'sometimes|string',
            'lname' => 'sometimes|string',
            'email' => 'sometimes|email|exists:suppliers,email',
            'phone' => 'sometimes|string',
            'address' => 'nullable|string',
        ]);

        return apiResponse('تم التحديث', $this->service->create($data), 201);
    }

    public function destroy($id)
    {
        return apiResponse('تم الحذف', $this->service->delete($id), 200);
    }
}
