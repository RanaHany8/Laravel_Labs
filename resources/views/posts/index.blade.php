@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-50 mt-6">
    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Community Insights</h1>
            <p class="text-gray-500 text-sm mt-1">Manage and explore all shared stories and updates.</p>
        </div>
        <a href="{{ route('posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-100">
            + Create New Post
        </a>
    </div>

    {{-- Table Container --}}
    <div class="relative overflow-x-auto rounded-xl border border-gray-100">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-5 font-bold">ID</th>
                    <th class="px-6 py-5 font-bold">Post Image</th> {{-- Lab 4 --}}
                    <th class="px-6 py-5 font-bold">Title</th>
                    <th class="px-6 py-5 font-bold">Posted By</th> {{-- Lab 4 --}}
                    <th class="px-6 py-5 font-bold text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($posts as $post)
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="px-6 py-4 font-bold text-gray-400">#{{ $post->id }}</td>
                    
                    {{-- lab4--}}
                    <td class="px-6 py-4">
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" 
                                 alt="Post Cover" 
                                 class="w-16 h-12 object-cover rounded-lg shadow-sm border border-gray-100">
                        @else
                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-[10px] text-gray-400">No Image</div>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-gray-900 font-semibold">{{ $post->title }}</td>
                    
                    {{-- lab4 --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xs">
                                {{ substr($post->user->name ?? 'U', 0, 1) }}
                            </div>
                            <span class="text-gray-700 font-medium">{{ $post->user->name ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4 text-center space-x-2">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="p-2 text-sky-600 hover:bg-sky-50 rounded-lg transition-colors" title="View Details">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>

                            <a href="{{ route('posts.edit', $post->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Post">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Move to trash?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Post">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-50 p-4 rounded-full mb-4">
                                <svg class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">No posts shared yet</h3>
                            <p class="text-gray-500">Be the first to publish a story.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination  --}}
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection