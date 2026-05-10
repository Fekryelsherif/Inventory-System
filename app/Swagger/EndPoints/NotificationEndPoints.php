<?php

namespace App\Swagger\EndPoints;

/**
 * @OA\Tag(
 *     name="Notifications",
 *     description="User Notifications"
 * )
 */
class NotificationEndPoints
{
    /**
     * @OA\Get(
     *     path="/api/notifications/unread",
     *     tags={"Notifications"},
     *     summary="Unread notifications",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function unread(){}

    /**
     * @OA\Post(
     *     path="/api/notifications/{id}/read",
     *     tags={"Notifications"},
     *     summary="Mark as read",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function markAsRead($id){}

    /**
     * @OA\Post(
     *     path="/api/notifications/read",
     *     tags={"Notifications"},
     *     summary="Mark all as read",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function markAllAsRead(){}

    /**
     * @OA\Get(
     *     path="/api/notifications/count",
     *     tags={"Notifications"},
     *     summary="Notifications count",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function count(){}

    /**
     * @OA\Delete(
     *     path="/api/notifications/{id}",
     *     tags={"Notifications"},
     *     summary="Delete notification",
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