<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\NewBlogCreated::class => [
            \App\Listeners\SendAdminNewBlogNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
