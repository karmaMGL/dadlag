<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern News Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    /* styles.css */
body {
    background-color: #f3f4f6;
}

header {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

marquee {
    font-weight: bold;
}

</style>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Add this script tag before the closing </body> tag -->
<script>
    // JavaScript for interactivity can go here
    // Example: Breaking news ticker update
    document.addEventListener("DOMContentLoaded", function() {
        const ticker = document.querySelector("marquee");
        const newsItems = [
            "Breaking News: Item 1",
            "Breaking News: Item 2",
            "Breaking News: Item 3",
        ];
        let currentItem = 0;
        setInterval(() => {
            currentItem = (currentItem + 1) % newsItems.length;
            ticker.textContent = newsItems[currentItem];
        }, 3000);
    });
</script>

    <!-- Header -->
    <header class="bg-white border-b">
        <div class="container mx-auto flex justify-between items-center py-4">
            <div class="text-3xl font-bold text-gray-900">
                NewsPortal
            </div>
            <nav class="space-x-4 text-gray-700">
                <a href="#" class="hover:text-blue-500">Home</a>
                <a href="#" class="hover:text-blue-500">World</a>
                <a href="#" class="hover:text-blue-500">Politics</a>
                <a href="#" class="hover:text-blue-500">Technology</a>
                <a href="#" class="hover:text-blue-500">Health</a>
            </nav>
            <div>
                <form action="{{route('search')}}" method="POST">
                    @csrf
                    <input type="text" name="name" id="name" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                </form>
            </div>
        </div>
    </header>
    <!-- Breaking News -->
    <div class="bg-red-500 text-white py-2">
        <div class="container mx-auto">
            <marquee>Breaking News: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</marquee>
        </div>
    </div>
    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        <!-- Featured Article -->
        {{-- https://via.placeholder.com/1200x400 --}}
        <section class="mb-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold mb-4">{{$latests[0]->Title}}</h2>
                <p class="text-gray-700 text-lg">{{$latests[0]->Description}}</p>
                <img src="{{ asset($latests[0]->ImgPath) }}" alt="Featured Article" class="rounded-lg w-full h-auto mb-6">
            </div>
        </section>

        <!-- Categories -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4">Latest</h3>
                <ul>
                    <?php
                    $treshold = (count($latests) > 2) ? 3 : count($latests);
                    ?>

                    @for ($s = 0 ; $s<$treshold;$s++)
                        <li class="mb-2">
                            <a type="submit" href="{{route('Page',$latests[$s]->id)}}" method="get" class="text-blue-500 hover:underline">{{$latests[$s]->Title}}</a>
                            <p class="text-gray-700">{{substr($latests[$s]->Description,0,15)}}...</p>

                        </li>
                    @endfor

                </ul>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4">{{$Category1!=null?$Category1[0]->Category:"idk"}}</h3>
                <ul>
                    @foreach ($Category1 as $ones)
                    <li class="mb-2">
                        <a href="{{route('Page',$ones->id)}}" class="text-blue-500 hover:underline">{{ $ones->Title;}}</a>
                        <p class="text-gray-700">{{substr($ones ->Description,0,15)}}...</p>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4">Category 3</h3>
                <ul>
                    <li class="mb-2">
                        <a href="#" class="text-blue-500 hover:underline">Article 7 Title</a>
                        <p class="text-gray-700">Short description of the article...</p>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-blue-500 hover:underline">Article 8 Title</a>
                        <p class="text-gray-700">Short description of the article...</p>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-blue-500 hover:underline">Article 9 Title</a>
                        <p class="text-gray-700">Short description of the article...</p>
                    </li>
                </ul>
            </div>
        </section>
    </main>
    <!-- Sidebar and Footer -->
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row -mx-4">
            <!-- Sidebar -->
            <aside class="w-full md:w-1/4 p-4">
                <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                    <h3 class="text-xl font-bold mb-4">Trending News</h3>
                    <ul>
                        @foreach ($Trend as $one)
                            <li class="mb-2">
                                <a href="{{route('Page',$one->id)}}" class="text-blue-500 hover:underline">{{$one->Title}}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                    <div class="space-y-4">
                        <a href="#" class="text-blue-500 hover:underline">Facebook</a>
                        <a href="#" class="text-blue-500 hover:underline">Twitter</a>
                        <a href="#" class="text-blue-500 hover:underline">Instagram</a>
                    </div>
                </div>
            </aside>
            <!-- Footer -->
            <footer class="w-full md:w-3/4 p-4">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold mb-4">About Us</h3>
                            <p class="text-gray-700">We are a leading news platform bringing you the latest updates from around the world. Stay informed with our comprehensive coverage.</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                            <p class="text-gray-700">Email: info@newsportal.com</p>
                        </div>
                    </div>
                    <div class="mt-6 text-gray-700">
                        <a href="#" class="hover:underline">Privacy Policy</a> | <a href="#" class="hover:underline">Terms of Service</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
