@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-10 rounded-2xl shadow-lg border border-gray-100">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Edit Post</h1>
        {{-- Displaying the ID using array or object syntax based on your data source --}}
        <p class="text-gray-600 mt-2">Update the information for the post with ID: <span class="font-bold text-blue-600">#{{ $post['id'] ?? $post->id }}</span></p>
    </div>

    {{-- The action must point to the update route with the post ID --}}
    <form action="{{ route('posts.update', $post['id'] ?? $post->id) }}" method="POST" class="space-y-8">
        @csrf
        {{-- Method spoofing is required for PUT requests in HTML forms --}}
        @method('PUT')

        <div>
            <label for="title" class="block mb-2 text-sm font-semibold text-gray-900">Post Title</label>
            <input type="text" name="title" id="title" value="{{ $post['title'] ?? $post->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-all" required>
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-semibold text-gray-900">Description</label>
            {{-- Fixed: Using 'description' instead of 'body' to match the database/controller key --}}
            <textarea id="description" name="description" rows="5" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition-all" required>{{ $post['description'] ?? $post->description }}</textarea>
        </div>

        <div>
            <label for="post_creator" class="block mb-2 text-sm font-semibold text-gray-900">Post Creator</label>
            {{-- Using a text input allows for custom names as requested --}}
            <input type="text" name="post_creator" id="post_creator" value="{{ $post['post_creator'] ?? $post->post_creator }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-all" required>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-sm px-8 py-3.5 text-center transition-all shadow-lg shadow-blue-200">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection