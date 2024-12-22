<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('create');
});

Route::post('post/store', [PostController::class, 'store'])->name('post.store');
