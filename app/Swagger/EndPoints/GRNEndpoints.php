<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="GRN",
 *     description="GRN Management"
 * )
 */
class GRNEndpoints
{
    /**
     * @OA\Post(
     *     path="/api/grns",
     *     summary="Receive goods (GRN)",
     *     security={{"sanctum":{}}},
     *     tags={"GRN"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"purchase_order_id","items"},
     *             @OA\Property(property="purchase_order_id", type="integer"),
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="item_id", type="integer"),
     *                     @OA\Property(property="received_quantity", type="number")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function store(){}

    /**
     * @OA\Get(
     *     path="/api/grns",
     *     summary="Get all GRNs",
     *     security={{"sanctum":{}}},
     *     tags={"GRN"},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index(){}

    /**
     * @OA\Get(
     *     path="/api/grns/{id}",
     *     summary="Get GRN",
     *     tags={"GRN"},
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
     *     path="/api/grns/{id}",
     *     summary="Update GRN",
     *     tags={"GRN"},
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
     *             required={"purchase_order_id","items"},
     *             @OA\Property(property="purchase_order_id", type="integer"),
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="item_id", type="integer"),
     *                     @OA\Property(property="received_quantity", type="number")
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
     *     path="/api/grns/{id}",
     *     summary="Delete GRN",
     *     security={{"sanctum":{}}},
     *     tags={"GRN"},
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
