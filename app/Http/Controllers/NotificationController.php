<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // This view will show ONLY static UI unless you pass notifications data
        // FIX IDEA (not applied): pass notifications to blade
        // return view('notifications.toasts', [
        //     'notifications' => auth()->user()->notifications
        // ]);

        // FIX: previously wrong view 'notifications.toasts'
        // CHANGED TO: viewAll page with real notifications
        return view('notifications.viewAll', [
            'notifications' => auth()->user()->notifications()->latest()->get()
        ]);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            // NOTE: paginate() is invalid here because this is a single notification query
            // ->paginate(4)
            ->first();

        if ($notification) {

            // Marks ONLY this notification as read
            // This updates "read_at" column in notifications table
            $notification->markAsRead();
        }

        return back();
    }

    public function markAllRead()
    {
        // Marks all unread notifications as read
        // IMPORTANT: this will NOT delete notifications, only updates read_at
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
}
