<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
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
                <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        <article class="bg-white p-6 rounded-lg shadow-lg">

            <h1 class="text-3xl font-bold mb-4" id="article-title">{{$data->Title}}</h1>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <span class="text-gray-500" id="article-date">Uploaded on: {{$data->created_at}}</span>
                </div>
                <div class="space-x-2">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm" id="article-tag">{{$data->Category}}</span>
                </div>
            </div>
            <p class="text-gray-700 text-lg" id="article-description">{{$data->Description}}</p>
            <img  src="{{asset($data->ImgPath)}}" alt="Article Image" class="rounded-lg w-full mb-6 h-100 w-100">
        </article>

        <!-- Comment Section -->
        <section class="bg-white p-6 rounded-lg shadow-lg mt-8">
            <h2 class="text-2xl font-bold mb-4">Comments</h2>
            <div id="comments-container" class="space-y-4 mb-6">
                <!-- Comments will be dynamically added here -->
                {{-- <div class="container mx-auto px-4 py-8">
                    <h2 class="text-2xl font-bold mb-4">Comments</h2> --}}
                    @foreach ($comments as $comment)
                        <div id="comments-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-4">
                                <img src="default-profile.jpg" alt="Profile Picture" class="w-8 h-8 rounded-full bg-gray-300 object-cover">
                                <div class="flex flex-col">
                                    <span class="block text-sm font-medium text-gray-700">Unknown</span>
                                    <p class="text-gray-700 mt-1">{{$comment->Comment}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach


                {{-- </div> --}}
            </div>
            <form id="comment-form" class="space-y-4" action="{{route('Comment',$data->id)}}" method="post">
                @csrf
                {{-- <div>
                    <label for="comment-name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="comment-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required>
                </div> --}}
                <div>
                    <label for="comment-text" class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea id="comment" name="comment" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Submit</button>
            </form>
        </section>
    </main>
    <!-- Footer -->
    <footer class="bg-white border-t mt-8">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center">
                <div class="text-gray-700">
                    &copy; 2024 NewsPortal. All rights reserved.
                </div>
                <div class="space-x-4 text-gray-700">
                    <a href="#" class="hover:text-blue-500">Privacy Policy</a>
                    <a href="#" class="hover:text-blue-500">Terms of Service</a>
                </div>

            </div>
        </div>
    </footer>
    <!-- JavaScript -->
    {{-- <script>
        // Example article data
        const articleData = {
            title: "How Technology is Changing the World",
            image: "https://via.placeholder.com/1200x600",
            description: "Technology is evolving at a rapid pace, affecting various aspects of our lives. From healthcare to communication, the advancements are remarkable...",
            tag: "Technology",
            date: "May 18, 2024"
        };

        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("article-title").textContent = articleData.title;
            document.querySelector("img").src = articleData.image;
            document.getElementById("article-description").textContent = articleData.description;
            document.getElementById("article-tag").textContent = articleData.tag;
            document.getElementById("article-date").textContent = `Uploaded on: ${articleData.date}`;

            // Handle comment form submission
            const commentForm = document.getElementById("comment-form");
            commentForm.addEventListener("submit", function(event) {
                event.preventDefault();

                const name = document.getElementById("comment-name").value;
                const text = document.getElementById("comment-text").value;

                addComment(name, text);

                commentForm.reset();
            });
        });

        function addComment(name, text) {
            const commentsContainer = document.getElementById("comments-container");

            const commentDiv = document.createElement("div");
            commentDiv.className = "bg-gray-100 p-4 rounded-lg shadow-inner";

            const commentName = document.createElement("h3");
            commentName.className = "font-bold text-gray-900";
            commentName.textContent = name;

            const commentText = document.createElement("p");
            commentText.className = "text-gray-700 mt-2";
            commentText.textContent = text;

            commentDiv.appendChild(commentName);
            commentDiv.appendChild(commentText);
            commentsContainer.appendChild(commentDiv);
        }
    </script> --}}
</body>
</html>
