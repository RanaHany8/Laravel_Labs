@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
    {{-- Page Header Section --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">All Posts</h1>
        <p class="text-gray-500 text-sm">A list of all the posts including their title, creator, and actions.</p>
    </div>

    {{-- Responsive Table Container --}}
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4 font-semibold text-gray-900">ID</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-gray-900">Title</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-gray-900">Posted By</th>
                    {{-- Note: Date column removed as it's not present in the current static data array --}}
                    <th scope="col" class="px-6 py-4 font-semibold text-gray-900 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop through the posts array passed from the Controller --}}
                @foreach($posts as $post)
                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors">
                    {{-- Accessing data using Array syntax [] because we are using Static Data (not Eloquent Objects) --}}
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $post['id'] }}</td>
                    <td class="px-6 py-4 text-gray-800 font-medium">{{ $post['title'] }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $post['post_creator'] }}</span>
                    </td>
                    
                    <td class="px-6 py-4 text-center space-x-2 flex items-center justify-center">
                        {{-- View Action: Links to the 'show' route using the post ID --}}
                        <a href="{{ route('posts.show', $post['id']) }}" class="text-white bg-sky-500 hover:bg-sky-600 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors">
                            View
                        </a>

                        {{-- Edit Action: Links to the 'edit' route to modify post details --}}
                        <a href="{{ route('posts.edit', $post['id']) }}" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors">
                            Edit
                        </a>
                        
                        {{-- Delete Action: Must use a Form with POST method for security --}}
                        {{-- onsubmit: Added JavaScript confirmation as required by Lab 2 --}}
                        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf {{-- CSRF Token is mandatory for all Laravel POST/DELETE forms --}}
                            @method('DELETE') {{-- Method Spoofing: Tells Laravel to treat this as a DELETE request --}}
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Empty State: Displayed only if the posts array is empty --}}
    @if(empty($posts))
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-gray-900">No posts yet</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new post.</p>
        </div>
    @endif
</div>
@endsection