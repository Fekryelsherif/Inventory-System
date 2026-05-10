<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Items",
 *     description="Items Management"
 * )
 */
class ItemEndPoints
{
     /**
 * @OA\Post(
 *     path="/api/items",
 *     tags={"Items"},
 *     summary="Create item",
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"name","category_id","unit_id","type"},
 *                 @OA\Property(property="name", type="string"),
 *                 @OA\Property(property="category_id", type="integer"),
 *                 @OA\Property(property="unit_id", type="integer"),
 *                 @OA\Property(property="type", type="string",enum={"raw","semi-finished","finished"},default="raw", example="raw"),
 *                 @OA\Property(property="image", type="string", format="binary")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=201, description="Created")
 * )
 */
    public function store(){}

    /**
     * @OA\Get(
     *     path="/api/items",
     *     tags={"Items"},
     *     security={{"sanctum":{}}},
     *     summary="Get all items",
     * @OA\Parameter(
 *         name="page",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Parameter(
 *         name="type",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index(){}

    /**
     * @OA\Get(
     *     path="/api/items/{id}",
     *     tags={"Items"},
     *     summary="Get item",
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
 *     path="/api/items/{id}",
 *     tags={"Items"},
 *     summary="Update item",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(property="name", type="string"),
 *                 @OA\Property(property="description", type="string"),
 *                 @OA\Property(property="category_id", type="integer"),
 *                 @OA\Property(property="unit_id", type="integer"),
 *                 @OA\Property(property="type", type="string"),
 *                 @OA\Property(property="image", type="string", format="binary")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Updated")
 * )
 */
    public function update($id){}

    /**
     * @OA\Delete(
     *     path="/api/items/{id}",
     *     tags={"Items"},
     *     summary="Delete item",
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