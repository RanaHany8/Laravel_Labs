<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto border-2 border-black bg-white p-8 shadow-[8px_8px_0_0]">
        <h1 class="text-4xl font-black mb-4">{{ $post['title'] }}</h1>
        <p class="text-lg text-gray-700 mb-8">{{ $post['body'] }}</p>
        
        <a href="/posts" class="text-blue-600 font-bold hover:underline">← Back to List</a>
    </div>
</body>
</html>