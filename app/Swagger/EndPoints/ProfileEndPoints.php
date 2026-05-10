<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Profile",
 *     description="User Profile"
 * )
 */
class ProfileEndPoints
{
    /**
     * @OA\Get(
     *     path="/api/profile",
     *     tags={"Profile"},
     *     summary="Get profile",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function show(){}

     /**
 * @OA\Put(
 *     path="/api/profile",
 *     tags={"Profile"},
 *     summary="Update profile",
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(property="fname", type="string"),
 *                 @OA\Property(property="lname", type="string"),
 *                 @OA\Property(property="email", type="string"),
 *                 @OA\Property(property="phone", type="string"),
 *                 @OA\Property(property="address", type="string"),
 *                 @OA\Property(property="profile_image", type="string", format="binary")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Updated"),
 *     @OA\Response(response=400, description="Bad Request")
 * )
 */
    public function update(){}
}