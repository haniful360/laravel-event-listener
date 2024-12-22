<?php

namespace App\Listeners;

use App\Events\PostPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyAdminOfPost implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostPublished $event): void
    {

        // notify admin
        // send to mail plain text
        Mail::raw("A blog post '{$event->post->title}' have been published", function ($message) {
            $message->to('recipient@example.com')
                ->subject('New Blog Post Published');
        });
    }
}
