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

        // PRIORITY: slug only
        if (!empty($data['blog_slug'])) {
            return redirect()->route('viewblog', $data['blog_slug']);
        }

        // fallback: convert ID → slug (SAFE)
        if (!empty($data['blog_id'])) {
            $blog = \App\Models\Blog::find($data['blog_id']);

            if ($blog) {
                return redirect()->route('viewblog', $blog->slug);
            }
        }

        return redirect()->route('dashboard');
    }
}
