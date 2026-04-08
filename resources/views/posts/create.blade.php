@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-10 bg-white shadow-2xl rounded-3xl mt-12 border border-gray-50">
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Create New Post</h2>
        <p class="text-gray-500 mt-2">Share your thoughts with the community</p>
    </div>

    {{-- (Validation Errors) --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        {{-- Post Title --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" 
                   class="w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-2xl p-4 bg-gray-50 transition-all outline-none" 
                   placeholder="Enter a catchy title...">
        </div>

        {{-- Post Creator --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Post Creator</label>
            <select name="user_id" class="w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-2xl p-4 bg-gray-50 transition-all outline-none appearance-none">
                <option value="" disabled selected>Select the author</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Post Image (Lab 4 Requirement) --}}
        <div class="p-4 bg-blue-50/50 rounded-2xl border-2 border-dashed border-blue-100">
            <label class="block text-sm font-bold text-blue-800 mb-2">Post Image</label>
            <input type="file" name="image" 
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all cursor-pointer">
            <p class="mt-2 text-xs text-blue-400">Supported formats: JPG, PNG (Max 2MB)</p>
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Description</label>
            <textarea name="description" rows="5" 
                      class="w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-2xl p-4 bg-gray-50 transition-all outline-none" 
                      placeholder="What is on your mind?">{{ old('description') }}</textarea>
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-200 transition-all transform active:scale-[0.98]">
                Publish Post
            </button>
            <a href="{{ route('posts.index') }}" class="block text-center mt-4 text-sm font-medium text-gray-400 hover:text-gray-600">Cancel and go back</a>
        </div>
    </form>
</div>
@endsection