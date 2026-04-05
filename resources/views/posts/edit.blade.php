@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-10 rounded-2xl shadow-lg border border-gray-100 mt-10">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Edit Post</h1>
        <p class="text-gray-600 mt-2">Update information for post: <span class="font-bold text-blue-600">#{{ $post->id }}</span></p>
    </div>

    {{-- Validation --}}
    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-50 rounded-lg">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block mb-2 text-sm font-semibold text-gray-900">Post Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-all">
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-semibold text-gray-900">Description</label>
            <textarea id="description" name="description" rows="5" 
                      class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition-all">{{ old('description', $post->description) }}</textarea>
        </div>

        <div>
            <label for="user_id" class="block mb-2 text-sm font-semibold text-gray-900">Post Creator</label>
            <select name="user_id" id="user_id" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-all">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $post->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-bold rounded-xl text-sm px-8 py-3.5 text-center transition-all shadow-lg shadow-blue-200">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection