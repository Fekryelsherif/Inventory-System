<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\CategoryServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return apiResponse('تم جلب البيانات', $this->service->getAll($request), 200);
    }

    public function store(Request $request) {
        $data=$request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
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
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
        ]);

        return apiResponse('تم التحديث', $this->service->update($id, $data), 200);
    }

    public function destroy($id)
    {
        return apiResponse('تم الحذف', $this->service->delete($id), 200);
    }
}
