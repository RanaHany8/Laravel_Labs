<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest; 
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $imagePath = null;
        
     
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'image_path' => $imagePath, 
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
        $imagePath = $post->image_path;

        if ($request->hasFile('image')) {
            
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete(); 
        return redirect()->route('posts.index')->with('success', 'Post moved to trash.');
    }

   
    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        
      
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        
        $post->forceDelete();
        return back()->with('success', 'Post and its image permanently deleted.');
    }

    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();
        return redirect()->route('posts.index')->with('success', 'Post restored successfully!');
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate(['body' => 'required|min:3']);
        $post = Post::findOrFail($postId);
        $post->comments()->create(['body' => $request->body]);
        return back()->with('success', 'Comment added successfully!');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->with('user')->paginate(10);
        return view('posts.trashed', compact('posts'));
    }
}