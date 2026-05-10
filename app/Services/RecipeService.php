<?php

namespace App\Services;

use App\Contracts\Repositories\RecipeRepositoryInterface;
use App\Contracts\Services\RecipeServiceInterface;
use App\Models\Item;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

class RecipeService implements RecipeServiceInterface
{
    protected $repository;
    public function __construct(RecipeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

  public function create($request)
{
    return DB::transaction(function () use ($request) {

        if (empty($request['items'])) {
        throw new \Exception('يجب إضافة مكونات للوصفة');
    }

        $outputItem = Item::findOrFail($request['output_item_id']);

        if ($outputItem->type !== ['finished', 'semi-finished',]) {
            throw new \Exception('Output item must be finished product');
        }

        $recipe = $this->repository->create([
            'output_item_id' => $request['output_item_id'],
            'output_quantity' => $request['output_quantity']
        ]);

        $itemsData = [];

        foreach ($request['items'] as $item) {

            $ingredient = Item::findOrFail($item['item_id']);

            if ($ingredient->id == $request['output_item_id']) {
                throw new \Exception('لا يمكن أن يكون المكون نفسه المنتج النهائي');
            }

            if (!in_array($ingredient->type, ['raw', 'semi-finished'])) {
                throw new \Exception('نوع الصنف ' . getItemName($ingredient->id) . ' غير صالح كمكون');
            }

            if ($item['quantity'] <= 0) {
                throw new \Exception('كمية المكون غير صالحة');
            }

            $itemsData[] = [
                'recipe_id' => $recipe->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity']
            ];
        }

        $recipe->items()->createMany($itemsData);

        return $recipe->load('items');
    });
}
   public function update($id, $request)
{
    return DB::transaction(function () use ($id, $request) {

        $recipe = $this->repository->find($id);

        $outputItem = Item::findOrFail($request['output_item_id']);

        if ($outputItem->type !== 'finished') {
            throw new \Exception('Output item must be finished product');
        }

        $recipe->update([
            'output_item_id' => $request['output_item_id'],
            'output_quantity' => $request['output_quantity'],
        ]);

        $recipe->items()->delete();

        $itemsData = [];

        foreach ($request['items'] as $item) {

            $ingredient = Item::findOrFail($item['item_id']);

            if ($ingredient->id == $request['output_item_id']) {
                throw new \Exception('لا يمكن أن يكون المكون نفسه المنتج النهائي');
            }

            if (!in_array($ingredient->type, ['raw', 'semi-finished'])) {
                throw new \Exception('نوع الصنف ' . getItemName($ingredient->id) . ' غير صالح كمكون');
            }

            $itemsData[] = [
                'recipe_id' => $recipe->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity']
            ];
        }

        $recipe->items()->createMany($itemsData);

        return $recipe->load('items');
    });
}

    public function delete($id)
    {
       $recipe= Recipe::with('items')->find($id);
       return $recipe->delete();
    }

    public function getById($id)
    {
        $recipe= Recipe::with('items')->find($id);
        return $recipe;
    }

    public function getAll($request)
    {
        $recipes= Recipe::with('items')->paginate(10);
        return $recipes;
    }

}
