<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Stock Counts",
 *     description="Stock Count Management"
 * )
 */
class StockCountEndPoints
{
    /**
     * @OA\Get(
     *     path="/api/stock-counts",
     *     tags={"Stock Counts"},
     *     summary="List Stock Counts",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index(){}

    /**
     * @OA\Post(
     *     path="/api/stock-counts",
     *     tags={"Stock Counts"},
     *     summary="Create Stock Count",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"items"},
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="item_id", type="integer"),
     *                     @OA\Property(property="actual_quantity", type="number")
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
     *     path="/api/stock-counts/{id}",
     *     tags={"Stock Counts"},
     *     summary="Show Stock Count",
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
     *     path="/api/stock-counts/{id}",
     *     tags={"Stock Counts"},
     *     summary="Update Stock Count",
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
     *             required={"items"},
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="item_id", type="integer"),
     *                     @OA\Property(property="actual_quantity", type="number")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated")
     * )
     */
    public function update($id){}

    /**
     * @OA\Post(
     *     path="/api/stock-counts/{id}/apply",
     *     tags={"Stock Counts"},
     *     summary="Apply Stock Count",
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
    public function apply($id){}

    /**
     * @OA\Delete(
     *     path="/api/stock-counts/{id}",
     *     tags={"Stock Counts"},
     *     summary="Delete Stock Count",
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
