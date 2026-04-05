@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 py-10">
    
    {{-- Post Details Card --}}
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="border-b border-gray-100 pb-6 mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ $post->title }}</h1>
                {{use Carbon }}
                <p class="text-gray-400 text-sm">
                    Published {{ $post->created_at->format('jS of F Y h:i A') }} 
                    <span class="mx-2">•</span> 
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
            @if($post->trashed())
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">In Trash</span>
            @endif
        </div>
        
        <div class="prose max-w-none text-gray-700 bg-gray-50 p-6 rounded-xl border border-gray-50">
            <p class="whitespace-pre-wrap leading-relaxed">{{ $post->description }}</p>
        </div>
    </div>

    {{-- Post Creator Info Card }}
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="border-b border-gray-100 pb-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Post Creator Info</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <p class="text-gray-700"><span class="font-bold text-gray-900">Name:</span> {{ $post->user->name ?? 'Unknown' }}</p>
            <p class="text-gray-700"><span class="font-bold text-gray-900">Email:</span> {{ $post->user->email ?? 'N/A' }}</p>
            <p class="text-gray-700"><span class="font-bold text-gray-900">Created At:</span> {{ $post->user->created_at ? $post->user->created_at->format('l jS of F Y') : 'N/A' }}</p>
        </div>
    </div>

    {{-- Polymorphic Comments Section--}}
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Comments ({{ $post->comments->count() }})</h2>
        
        {{--cooments --}}
        <div class="space-y-4 mb-8">
            @forelse($post->comments as $comment)
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-gray-800">{{ $comment->body }}</p>
                    <small class="text-gray-400 mt-2 block">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p class="text-gray-500 italic">No comments yet. Be the first to comment!</p>
            @endforelse
        </div>

        {{--add comments --}}
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="space-y-4">
            @csrf
            <textarea name="body" rows="3" required
                      class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-blue-100 outline-none"
                      placeholder="Share your thoughts on this post..."></textarea>
            <button type="submit" class="bg-blue-600 text-white font-bold px-6 py-2.5 rounded-xl hover:bg-blue-700 transition-all">
                Post Comment
            </button>
        </form>
    </div>

    {{-- Actions --}}
    <div class="flex space-x-4">
        <a href="{{ route('posts.index') }}" class="text-gray-700 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-sm px-6 py-3 transition-colors">
            ← Back to All Posts
        </a>
        @if(!$post->trashed())
            <a href="{{ route('posts.edit', $post->id) }}" class="text-white bg-blue-600 hover:bg-blue-700 font-bold rounded-xl text-sm px-6 py-3 transition-colors shadow-lg shadow-blue-200">
                Edit This Post
            </a>
        @endif
    </div>
</div>
@endsection