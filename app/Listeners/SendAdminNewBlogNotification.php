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
        // OLD (BROKEN - column does not exist)
        // $admins = User::where('is_users', true)->get();

        // FIXED (temporary solution)
        $admins = User::all();

        // If no users exist, stop execution
        if ($admins->isEmpty()) {
            return;
        }

        Notification::send($admins, new NewBlogPublished($event->blog));
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
    }
}
