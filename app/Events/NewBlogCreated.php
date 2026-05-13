<?php

namespace App\Events;

use App\Models\Blog;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewBlogCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Blog $blog;

    /**
     * Create a new event instance.
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }
}
