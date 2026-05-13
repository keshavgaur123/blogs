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
        // 1) Retrieve admin users. Adjust the query to match your app's admin flag/role.
        $admins = User::where('is_admin', true)->get();

        // If no admins configured, exit early.
        if ($admins->isEmpty()) {
            return;
        }

        // 2) Send the notification via Laravel's Notification facade.
        // This will queue mail/database/broadcast jobs defined in NewBlogPublished::via().
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
