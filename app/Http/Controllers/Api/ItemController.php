<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ItemServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $service;

    public function __construct(ItemServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
        'type'
        ]);
        $search = $request->name;
        return apiResponse('تم جلب البيانات', $this->service->paginate(6, $filters, $search), 200);
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'type' => 'required|in:raw,semi-finished,finished',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $data['image'] = $path;
        }

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
            'category_id' => 'sometimes|exists:categories,id',
            'unit_id' => 'sometimes|exists:units,id',
            'type' => 'sometimes|in:raw,semi-finished,finished',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $data['image'] = $path;
        }
        return apiResponse('تم التحديث', $this->service->update($id, $data), 200);
    }

    public function destroy($id)
    {
        return apiResponse('تم الحذف', $this->service->delete($id), 200);
    }
}
