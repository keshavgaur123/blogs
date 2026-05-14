<?php

namespace App\Notifications;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewBlogPublished extends Notification
{
    use Queueable;

    protected Blog $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New blog published: ' . $this->blog->title)
            ->line('A new blog post was published.')
            ->action('View Post', url(route('blogs.show', $this->blog->slug)));
    }

    // public function toArray($notifiable)
    // {
    //     return [
    //         'type' => 'new_blog',
    //         'blog_id' => $this->blog->id,
    //         'title' => $this->blog->title,
    //     ];
    // }

    public function toArray($notifiable)
    {
        return [
            'user_name' => auth()->user()->name ?? 'System',
            'message' => 'published a new blog',
            'title' => $this->blog->title,
            'blog_id' => $this->blog->id,
        ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}





// namespace App\Notifications;

// use App\Models\Blog;
// use Illuminate\Bus\Queueable;
// use Illuminate\Notifications\Notification;
// use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Messages\BroadcastMessage;

// class NewBlogPublished extends Notification
// {
//     use Queueable;

//     protected Blog $blog;

//     public function __construct(Blog $blog)
//     {
//         $this->blog = $blog;
//     }

//     public function via($notifiable)
//     {
//         return ['mail', 'database', 'broadcast'];
//     }

//     public function toMail($notifiable)
//     {
//         return (new MailMessage)
//             ->subject('New blog published: ' . $this->blog->title)
//             ->greeting('Hello!')
//             ->line('A new blog post was published.')
//             ->line('Title: ' . $this->blog->title)
//             ->action('View post', url(route('blogs.show', $this->blog->id)))
//             ->line('Author ID: ' . $this->blog->user_id);
//     }

//     public function toArray($notifiable)
//     {
//         return [
//             'type' => 'new_blog',
//             'blog_id' => $this->blog->id,
//             'title' => $this->blog->title,
//             'created_at' => $this->blog->created_at->toDateTimeString(),
//         ];
//     }

//     public function toBroadcast($notifiable)
//     {
//         return new BroadcastMessage($this->toArray($notifiable));
//     }
// } 
