<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment; 
use App\Http\Requests\StorePostRequest; 
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index() 
    {
       
        $posts = Post::with('user')->latest()->paginate(10); 
        return view('posts.index', compact('posts'));
    }

   
    public function create()
    {
        
        $users = User::all();
        return view('posts.create', compact('users'));
    }

   
    public function store(StorePostRequest $request)
    {
       
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id, 
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

   
    public function show($id) 
    {
        $post = Post::with(['user', 'comments'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

  
    public function edit($id) 
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

   
    public function update(UpdatePostRequest $request, $id) 
    {
        $post = Post::findOrFail($id);
        
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

   
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post moved to trash successfully!');
    }

    
    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();

        return redirect()->route('posts.index')->with('success', 'Post restored successfully!');
    }

   
    public function storeComment(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

   
        $request->validate([
            'body' => 'required|min:3'
        ]);

        
        $post->comments()->create([
            'body' => $request->body
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

  
    public function trashed()
    {
        $posts = Post::onlyTrashed()->with('user')->paginate(10);
        return view('posts.trashed', compact('posts'));
    }
}