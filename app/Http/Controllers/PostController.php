<?php

namespace App\Http\Controllers;

use App\Events\PostPublished;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());

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
