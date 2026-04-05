@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 transition-all hover:shadow-sky-100">
            
            <div class="bg-gradient-to-r from-blue-600 to-sky-500 p-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Create New Post</h2>
                <p class="mt-2 text-blue-100">Share your thoughts with the world.</p>
            </div>

            {{-- عرض رسائل الخطأ العامة إن وجدت --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-50 rounded-lg mx-8 mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST" class="p-8 space-y-6">
                @csrf 

                {{-- Title Input --}}
                <div>
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Post Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full px-4 py-3 rounded-xl border @error('title') border-red-500 @else border-gray-200 @enderror focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                </div>

                {{-- Creator Select Dropdown (التعديل الأساسي) --}}
                <div>
                    <label for="user_id" class="block text-sm font-bold text-gray-700 mb-2">Post Creator</label>
                    <select name="user_id" id="user_id" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Description Textarea --}}
                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="5" 
                              class="w-full px-4 py-3 rounded-xl border @error('description') border-red-500 @else border-gray-200 @enderror focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all resize-none">{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center space-x-4 pt-4">
                    <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                        Publish Post
                    </button>
                    <a href="{{ route('posts.index') }}" class="px-8 py-4 bg-gray-50 text-gray-500 font-bold rounded-xl hover:bg-gray-100 transition-all border border-gray-100">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection