<?php

use App\Http\Controllers\NotificationController;

if (!function_exists('send_notification')) {

    function send_notification($user_ids, $message, $link, $type = null)
    {
        NotificationController::send_notification($user_ids, $message, $link, $type);
    }
}
