<?php

namespace App\Repositories;

use App\Contracts\Repositories\RecipeRepositoryInterface;
use App\Models\Recipe;

class RecipeRepository extends BaseRepository implements RecipeRepositoryInterface
{
    public function __construct(Recipe $model)
    {
        $this->model = $model;
    }
}
