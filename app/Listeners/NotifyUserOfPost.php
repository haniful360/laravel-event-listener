<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOfPost implements ShouldQueue
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
        $users = User::all();
        foreach ($users as $user) {
            Mail::raw("Hey '{$user->name}', checkout your new post:{$event->post->title}", function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('New Blog post!');
            });
        }
    }
}
