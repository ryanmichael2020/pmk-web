<?php

namespace App\Http\Controllers\Core\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;
use App\Models\Notification\NotificationType;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public static function markAllRecentAsRead($user_id)
    {
        $response = array();
        try {
            $now = Carbon::now();
            $notifications = Notification::where('recipient_id', $user_id)
                ->where('created_at', '<=', $now)
                ->update([
                    'read' => true,
                ]);

            $response['message'] = 'Notifications successfully marked as read.';
            $response['status_code'] = Response::HTTP_OK;
        } catch (QueryException $exception) {
            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to mark notifications as read.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to mark notifications as read.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        }

        return $response;
    }

    public static function createNotification($sender_id, $recipient_id, $notification_type_id, $notification_message, $custom_notification_title = null)
    {
        $notification = new Notification();
        $notification->sender_id = $sender_id;
        $notification->recipient_id = $recipient_id;
        $notification->notification_type_id = $notification_type_id;
        $notification->title = ($custom_notification_title != null) ? $custom_notification_title : self::getGenericNotificationTitle($notification_type_id);
        $notification->message = $notification_message;
        $notification->save();
    }

    protected static function getGenericNotificationTitle($notification_type_id)
    {
        if ($notification_type_id == NotificationType::$JOB_APPLICATION_NEW) {
            return 'New Job Applicant';
        } else if ($notification_type_id == NotificationType::$JOB_APPLICATION_UPDATE) {
            return 'Job Application Update';
        } else if ($notification_type_id == NotificationType::$JOB_OFFER_RECEIVED) {
            return 'New Job Offer';
        } else if ($notification_type_id == NotificationType::$JOB_OFFER_ACCEPTED) {
            return 'Job Offer Accepted';
        } else if ($notification_type_id == NotificationType::$JOB_OFFER_DECLINED) {
            return 'Job Offer Declined';
        } else {
            return '';
        }
    }
}
