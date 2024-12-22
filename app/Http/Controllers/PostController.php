<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

        // send to mail plain text
        Mail::raw("A blog post '{$post->title}' have been published", function ($message) {
            $message->to('recipient@example.com')
                ->subject('New Blog Post Published');
        });

        return back();
    }
}
