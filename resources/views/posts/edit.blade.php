@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-10 rounded-2xl shadow-lg border border-gray-100 mt-10">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Edit Post</h1>
        <p class="text-gray-600 mt-2">Update information for post: <span class="font-bold text-blue-600">#{{ $post->id }}</span></p>
    </div>

    {{-- Validation --}}
    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 bg-red-50 rounded-xl border border-red-100">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- encrypte --}}
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Post Title --}}
        <div>
            <label for="title" class="block mb-2 text-sm font-semibold text-gray-900">Post Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-all outline-none">
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block mb-2 text-sm font-semibold text-gray-900">Description</label>
            <textarea id="description" name="description" rows="5" 
                      class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">{{ old('description', $post->description) }}</textarea>
        </div>

        {{-- Post Image (Lab 4 Update) --}}
        <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
            <label for="image" class="block mb-3 text-sm font-bold text-blue-900">Update Post Image</label>
            
            @if($post->image_path)
                <div class="mb-4">
                    <p class="text-xs text-gray-500 mb-2">Current Image:</p>
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-32 h-32 object-cover rounded-xl shadow-sm border border-white">
                </div>
            @endif

            <input type="file" name="image" id="image" 
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none p-2">
            <p class="mt-2 text-xs text-blue-600 font-medium">Leave blank to keep current image.</p>
        </div>

        {{-- Post Creator --}}
        <div>
            <label for="user_id" class="block mb-2 text-sm font-semibold text-gray-900">Post Creator</label>
            <select name="user_id" id="user_id" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-all outline-none cursor-pointer">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $post->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end space-x-4 pt-4">
            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900 font-bold text-sm px-4">Cancel</a>
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-bold rounded-xl text-sm px-10 py-3.5 text-center transition-all shadow-lg shadow-blue-200">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection