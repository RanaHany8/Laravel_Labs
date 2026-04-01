<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-xl mx-auto border-2 border-black bg-white p-8 shadow-[6px_6px_0_0]">
        <h2 class="text-2xl font-bold mb-6">Create New Post</h2>
        
        <form>
            <div class="mb-4">
                <label class="block font-bold mb-2 text-gray-700">Title</label>
                <input type="text" 
                       placeholder="Enter post title" 
                       class="w-full border-2 border-black p-2 focus:bg-yellow-50 outline-none transition">
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-2 text-gray-700">Content</label>
                <textarea placeholder="Write your post here..." 
                          rows="4" 
                          class="w-full border-2 border-black p-2 focus:bg-yellow-50 outline-none transition"></textarea>
            </div>

            <button type="submit" 
                    class="w-full bg-black text-white font-bold py-3 hover:bg-gray-800 shadow-[4px_4px_0_0_rgba(0,0,0,0.5)] active:shadow-none active:translate-x-[2px] active:translate-y-[2px] transition-all">
                Save Post
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/posts" class="text-sm font-bold underline hover:text-blue-600">
                Cancel and go back
            </a>
        </div>
    </div>

</body>
</html>