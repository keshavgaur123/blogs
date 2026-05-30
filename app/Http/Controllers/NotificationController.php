<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.viewAll', [
            'notifications' => auth()->user()
                ->notifications()
                ->latest()
                ->get()
        ]);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return back();
    }

    public function markAllRead()
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    }

    public function open($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        $data = $notification->data ?? [];

        // ✅ PRIORITY: slug (your route uses slug)
        if (!empty($data['blog_slug'])) {
            return redirect()->route('blogs.show', $data['blog_slug']);
        }

        // ⚠️ fallback if only ID exists
        if (!empty($data['blog_id'])) {
            return redirect('/blogs/' . $data['blog_id']);
        }

        return redirect()->route('dashboard');
    }
}
