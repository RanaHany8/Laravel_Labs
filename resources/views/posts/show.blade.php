@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    {{-- Post Details Card --}}
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="border-b border-gray-100 pb-6 mb-6">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ $post['title'] }}</h1>
            <p class="text-gray-500">Post details and content.</p>
        </div>
        
        <div class="prose max-w-none text-gray-700">
            <p class="whitespace-pre-wrap leading-relaxed">{{ $post['body'] ?? $post['description'] }}</p>
        </div>
    </div>

    {{-- Post Creator Info Card --}}
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="border-b border-gray-100 pb-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Post Creator Info</h2>
        </div>
        <div class="space-y-4">
            <p class="text-gray-700"><span class="font-bold text-gray-900">Name:</span> {{ $post['post_creator'] }}</p>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex space-x-4">
        <a href="{{ route('posts.index') }}" class="text-gray-700 bg-gray-100 hover:bg-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors">
            Back to All Posts
        </a>
        <a href="{{ route('posts.edit', $post['id']) }}" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors">
            Edit This Post
        </a>
    </div>
</div>
@endsection