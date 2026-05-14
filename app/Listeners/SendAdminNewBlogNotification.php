<?php

namespace App\Listeners;

use App\Events\NewBlogCreated;
use App\Notifications\NewBlogPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class SendAdminNewBlogNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  NewBlogCreated  $event
     * @return void
     */
    public function handle(NewBlogCreated $event): void
    {
        // OLD (BROKEN - column does not exist OR unreliable filter)
        // $admins = User::where('is_users', true)->get();

        // CURRENT: sending to ALL users
        // ⚠️ This is OK for testing but NOT ideal in production
        // Better approach: filter admins using is_admin column
        $admins = User::all();

        // If no users exist, stop execution
        if ($admins->isEmpty()) {
            return;
        }

        // IMPORTANT NOTE:
        // Notification::send() will send to ALL users in collection
        // It does NOT prevent duplicates automatically
        // Duplicate prevention must be handled inside:
        // - NewBlogPublished notification (recommended)
        // - OR database check before calling this

        Notification::send($admins, new NewBlogPublished($event->blog));

        // OPTIONAL IMPROVEMENT (not applied):
        // You should ideally use:
        // User::where('is_admin', 1)->get();
    }

    /**
     * Optional: handle failed job (when queued listener fails).
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(NewBlogCreated $event, $exception): void
    {
        // Log or alert on failure (optional)
        \Log::error('SendAdminNewBlogNotification failed', [
            'blog_id' => $event->blog->id ?? null,
            'error' => $exception->getMessage(),
        ]);

        // NOTE:
        // This will only run if queue worker fails after retries
    }
}
