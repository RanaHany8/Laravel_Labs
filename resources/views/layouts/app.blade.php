<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITI Blog Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    
    <nav class="bg-white border-b border-gray-200 fixed w-full z-20 top-0 start-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('posts.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-800">ITI Blog</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="{{ route('posts.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                    + Create Post
                </a>
            </div>
        </div>
    </nav>

    <div class="container max-w-7xl mx-auto px-4 md:px-6 pt-24 pb-12">
        @yield('content')
    </div>

</body>
</html>