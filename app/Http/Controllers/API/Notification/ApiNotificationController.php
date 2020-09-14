<?php

namespace App\Http\Controllers\API\Notification;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Notification\NotificationController;
use Illuminate\Http\Request;

class ApiNotificationController extends Controller
{
    public function markAllRecentAsRead(Request $request)
    {
        $user_id = $request->user_id;

        $response = NotificationController::markAllRecentAsRead($user_id);
        return response()->json($response);
    }
}
