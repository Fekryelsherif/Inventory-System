<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Reports",
 *     description="Reports APIs"
 * )
 */
class ReportEndPoints
{
    /**
     * @OA\Get(
     *     path="/api/reports/inventory",
     *     tags={"Reports"},
     *     summary="Inventory Report",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function inventory(){}

    /**
     * @OA\Get(
     *     path="/api/reports/profit",
     *     tags={"Reports"},
     *     summary="Profit Report",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function profit(){}

    /**
     * @OA\Get(
     *     path="/api/reports/movement",
     *     tags={"Reports"},
     *     summary="Movement Report",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function movement(){}

    /**
     * @OA\Get(
     *     path="/api/reports/variance",
     *     tags={"Reports"},
     *     summary="Variance Report",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function variance(){}

    /**
     * @OA\Get(
     *     path="/api/reports/daily",
     *     tags={"Reports"},
     *     summary="Daily Report",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function daily(){}

    /**
     * @OA\Get(
     *     path="/api/reports/top-products",
     *     tags={"Reports"},
     *     summary="Top Products",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function topProducts(){}
}
