<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Production",
 *     description="Production Management"
 * )
 */
class ProductionEndPoints
{
    /**
     * @OA\Post(
     *     path="/api/productions",
     *     tags={"Production"},
     *     summary="Create production",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"recipe_id","quantity"},
     *             @OA\Property(property="recipe_id", type="integer"),
     *             @OA\Property(property="quantity", type="number")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(){}

    /**
     * @OA\Get(
     *     path="/api/productions",
     *     tags={"Production"},
     *     summary="Get all productions",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index(){}

    /**
     * @OA\Get(
     *     path="/api/productions/{id}",
     *     tags={"Production"},
     *     summary="Get production",
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
     *     path="/api/productions/{id}",
     *     tags={"Production"},
     *     summary="Update production",
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
     *             required={"recipe_id","quantity"},
     *             @OA\Property(property="recipe_id", type="integer"),
     *             @OA\Property(property="quantity", type="number")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated")
     * )
     */
    public function update($id){}

    /**
     * @OA\Delete(
     *     path="/api/productions/{id}",
     *     tags={"Production"},
     *     summary="Delete production",
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

    // execute function 

    /**
 * @OA\Post(
 *     path="/api/productions/{id}/execute",
 *     summary="Execute Production Order",
 *     description="Executes a production order, consumes raw materials using FIFO, and adds finished goods to inventory.",
 *     operationId="executeProductionOrder",
 *     security={{"sanctum":{}}},
 *     tags={"Production"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Production Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Production executed successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", example="completed"),
 *             @OA\Property(property="total_cost", type="number", format="float", example=1500.75),
 *             @OA\Property(
 *                 property="recipe",
 *                 type="object",
 *                 @OA\Property(property="output_item_id", type="integer", example=5),
 *                 @OA\Property(property="output_quantity", type="number", example=10)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Business logic error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Insufficient stock for item ID 3")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Production order not found"
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */
public function execute(){}
    
}