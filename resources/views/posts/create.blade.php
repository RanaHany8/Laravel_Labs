@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        {{-- Card Container --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 transition-all hover:shadow-sky-100">
            
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-sky-500 p-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Create New Post</h2>
                <p class="mt-2 text-blue-100">Share your thoughts with the world.</p>
            </div>

            {{-- Form Section --}}
            <form action="{{ route('posts.store') }}" method="POST" class="p-8 space-y-6">
                @csrf 

                {{-- Title Input --}}
                <div>
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Post Title</label>
                    <input type="text" name="title" id="title" required
                           placeholder="Enter a catchy title..." 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder-gray-400">
                </div>

                {{-- Creator Input --}}
                <div>
                    <label for="post_creator" class="block text-sm font-bold text-gray-700 mb-2">Post Creator</label>
                    <input type="text" name="post_creator" id="post_creator" required
                           placeholder="Type your name here..." 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder-gray-400">
                </div>

                {{-- Description Textarea --}}
                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="5" required
                              placeholder="What's on your mind? Write it here..." 
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder-gray-400 resize-none"></textarea>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center space-x-4 pt-4">
                    <button type="submit" 
                            class="flex-1 bg-blue-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                        Publish Post
                    </button>
                    
                    <a href="{{ route('posts.index') }}" 
                       class="px-8 py-4 bg-gray-50 text-gray-500 font-bold rounded-xl hover:bg-gray-100 transition-all border border-gray-100">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        {{-- Footer Note --}}
        <p class="text-center mt-8 text-gray-400 text-sm">
            Make sure to double-check your content before publishing.
        </p>
    </div>
</div>
@endsection