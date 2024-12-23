<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $notifications = Notification::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();

            $totalNotifications = $notifications->count();

            return ['notifications' => $notifications, 'totalNotifications' => $totalNotifications];
        }

        return ['notifications' => [], 'totalNotifications' => 0];
    }

    public function destroyAll()
    {
        if (Auth::check()) {
            Notification::where('user_id', Auth::id())->delete();
        }

        return redirect()->route('notifications.index');
    }
}
