<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 

class PostController extends Controller
{
  
    public function index() 
    {
        $posts = Post::all(); 
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

   
    public function store(Request $request)
    {
     
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'post_creator' => $request->post_creator,
        ]);

        return redirect()->route('posts.index');
    }

  
    public function show($id) 
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

  
    public function edit($id) 
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

  
    public function update(Request $request, $id) 
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'post_creator' => $request->post_creator,
        ]);

        return redirect()->route('posts.index');
    }
    

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}