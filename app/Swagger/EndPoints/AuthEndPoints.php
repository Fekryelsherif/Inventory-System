<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication APIs"
 * )
 */
class AuthEndPoints
{

    // login

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login User",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email",example="admin@system.com"),
     *            @OA\Property(property="password", type="string", format="password",example="123456"),
     *         )
     *     ),
     *     @OA\Response(
        *         response=200,
        *         description="Success"
        *     )
        * )
        */
    public function login(){}


    //logout
    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout User",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function logout(){}


    // refresh token
    /**
     * @OA\Post(
     *     path="/api/auth/refresh-token",
     *     summary="Refresh Auth Token",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *        description="Success"
     *    )
     * )
     */
    public function refreshToken(){}

   /**
     * @OA\Post(
     *     path="/api/auth/send-otp",
     *     summary="Send OTP to email",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", example="test@gmail.com")
     *         )
     *     ),
     *     @OA\Response(response=200, description="OTP Sent")
     * )
     */
    public function sendOtp(){}


     /**
     * @OA\Post(
     *     path="/api/auth/reset-password-otp",
     *     summary="Reset password using OTP",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"otp","password","password_confirmation"},
     *             @OA\Property(property="otp", type="string", example="123456"),
     *             @OA\Property(property="password", type="string", example="123456"),
     *             @OA\Property(property="password_confirmation", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Password reset successful"),
     *     @OA\Response(response=400, description="Invalid OTP")
     * )
     */

    public function resetPasswordWithOtp(){}

}
