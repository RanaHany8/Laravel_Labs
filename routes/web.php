<?php

use Illuminate\Support\Facades\Route;


Route::get('/posts', function () {
    $posts = [
        ['id' => 1, 'title' => 'post 1', 'body' => 'this is body post 1'],
        ['id' => 2, 'title' => 'post 2', 'body' => 'this is body post 2'],
        ['id' => 3, 'title' => 'post 3', 'body' => 'this is body post 3'],
        ['id' => 4, 'title' => 'post 4', 'body' => 'this is body post 4'],
    ];
    return view('posts.index', compact('posts'));
});


Route::get('/posts/create', function () {
    return view('posts.create');
});


Route::get('/posts/{id}', function ($id) {
    $post = [
        'id' => $id, 
        'title' => 'post ' . $id, 
        'body' => 'this is body post ' . $id
    ];
    return view('posts.show', compact('post'));
})->where('id', '[0-9]+');