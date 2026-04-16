<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    
    public function index() 
    {
       
        $posts = Post::with('user')->paginate(10);
        
        return PostResource::collection($posts);
    }

    
    public function show($id) 
    {
        $post = Post::with('user')->findOrFail($id);
        return new PostResource($post);
    }

    
    public function store(Request $request) 
    {
       
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::create([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => Auth::id() ?? 1, 
        ]);

        
        return response()->json([
            'message' => 'Post Created Successfully',
            'data'    => new PostResource($post)
        ], 201);
    }

   
    public function update(Request $request, $id) 
    {
        $post = Post::findOrFail($id);
        
        $post->update($request->only(['title', 'description']));

        return response()->json([
            'message' => 'Update Done',
            'data'    => new PostResource($post)
        ], 200);
    }

  
    public function destroy($id) 
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Delete Done'
        ], 200);
    }
}