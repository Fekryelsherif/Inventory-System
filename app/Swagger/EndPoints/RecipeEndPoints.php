<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Recipes",
 *     description="Recipe Management APIs"
 * )
 */
class RecipeEndPoints
{
    /**
     * @OA\Get(
     *     path="/api/recipes",
     *     tags={"Recipes"},
     *     summary="List Recipes",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index(){}

    /**
     * @OA\Post(
     *     path="/api/recipes",
     *     tags={"Recipes"},
     *     summary="Create Recipe",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"output_item_id","output_quantity","items"},
     *             @OA\Property(property="output_item_id", type="integer"),
     *             @OA\Property(property="output_quantity", type="number"),
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="item_id", type="integer"),
     *                     @OA\Property(property="quantity", type="number")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(){}

    /**
     * @OA\Get(
     *     path="/api/recipes/{id}",
     *     tags={"Recipes"},
     *     summary="Show Recipe",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function show($id){}

    /**
     * @OA\Put(
     *     path="/api/recipes/{id}",
     *     tags={"Recipes"},
     *     summary="Update Recipe",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"output_item_id","output_quantity","items"},
     *             @OA\Property(property="output_item_id", type="integer"),
     *             @OA\Property(property="output_quantity", type="number"),
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="item_id", type="integer"),
     *                     @OA\Property(property="quantity", type="number")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated")
     * )
     */
    public function update($id){}

    /**
     * @OA\Delete(
     *     path="/api/recipes/{id}",
     *     tags={"Recipes"},
     *     summary="Delete Recipe",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Deleted")
     * )
     */
    public function destroy($id){}
}
