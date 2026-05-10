<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Units",
 *     description="Units Management"
 * )
 */
class UnitEndPoints
{
    /**
     * @OA\Get(
     *     path="/api/units",
     *     tags={"Units"},
     *     summary="Get all units",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index(){}

    /**
     * @OA\Post(
     *     path="/api/units",
     *     tags={"Units"},
     *     summary="Create Unit",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(){}

    /**
     * @OA\Get(
     *     path="/api/units/{id}",
     *     tags={"Units"},
     *     summary="Show Unit",
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
     *     path="/api/units/{id}",
     *     tags={"Units"},
     *     summary="Update Unit",
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
     *             required={"name"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated")
     * )
     */
    public function update($id){}

    /**
     * @OA\Delete(
     *     path="/api/units/{id}",
     *     tags={"Units"},
     *     summary="Delete Unit",
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
