<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">All Posts</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($posts as $post)
            <a href="/posts/{{ $post['id'] }}" class="block border-2 border-black bg-white p-6 shadow-[4px_4px_0_0] hover:bg-yellow-100 transition">
                <h3 class="text-xl font-bold">{{ $post['title'] }}</h3>
                <p class="mt-2 text-gray-600">{{ $post['body'] }}</p>
            </a>
            @endforeach
        </div>

        <div class="mt-10">
            <a href="/posts/create" class="inline-block border-2 border-black bg-black text-white px-6 py-2 font-bold hover:bg-white hover:text-black transition">
                + Add New Post
            </a>
        </div>
    </div>
</body>
</html>