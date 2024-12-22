<?php

namespace App\Http\Controllers;

use App\Events\PostPublished;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);



        // notify all user

        PostPublished::dispatch($post);
        // event(new PostPublished($post->title, $post->content));

        return back();
    }
}
