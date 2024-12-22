<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        // notify admin
        // send to mail plain text
        Mail::raw("A blog post '{$post->title}' have been published", function ($message) {
            $message->to('recipient@example.com')
                ->subject('New Blog Post Published');
        });

        // notify all user

        $users = User::all();
        foreach($users as $user){
            Mail::raw("Hey '{$user->name}', checkout your new post: {$post->title}", function($message) use ($user){
                $message->to($user->email)
                        ->subject('New Blog post!');
            });
        }
        
        return back();
    }
}
