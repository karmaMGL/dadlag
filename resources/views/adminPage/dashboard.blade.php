<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b">
            <div class="container mx-auto flex justify-between items-center py-4">
                <div class="text-3xl font-bold text-gray-900">
                    Admin Dashboard
                </div>
                <nav class="space-x-4 text-gray-700">
                    <a href="{{route('home')}}" class="hover:text-blue-500">Home</a>
                    <a href="article.html" class="hover:text-blue-500">View Articles</a>
                </nav>
            </div>
        </header>
        <!-- Main Content -->
        <main class="container mx-auto mt-8 flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Add Blog Section -->
                <section class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Add New Blog Post</h2>
                    <form id="add-blog-form" class="space-y-4" method="POST" action="{{route('PublishPost')}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="blog-title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="blog-description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required></textarea>
                        </div>
                        <div>
                            <label for="blog-image" class="block text-sm font-medium text-gray-700">Image URL</label>
                            <input type="file" name="img" id="img" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="blog-tag" class="block text-sm font-medium text-gray-700">Tag</label>
                            <select name="category" id="category"class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500">
                                @foreach ($Category as  $s)
                                  <option value="{{$s->name}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Add Blog</button>
                    </form>
                </section>

                <!-- Manage Tags Section -->
                <section class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Manage Tags</h2>
                    <form id="add-tag-form" class="space-y-4" method="POST" action="{{route('NewCategory')}}">
                        @csrf
                        <div>
                            <label for="tag-name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Add Tag</button>
                    </form>
                    <div class="overflow-auto max-h-64 max-w-full">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tag</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Count</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($Category as $o)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$o->id}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$o->name}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">not yet</td>
                                    </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>


                </section>
            </div>

            <!-- Blog Posts Table -->
            <section class="bg-white p-6 rounded-lg shadow-lg mt-8">
                <h2 class="text-2xl font-bold mb-4">Blog Posts</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Title</th>
                                <th class="py-2 px-4 border-b">Description</th>
                                <th class="py-2 px-4 border-b">Tag</th>
                                <th class="py-2 px-4 border-b">Date</th>
                            </tr>
                        </thead>
                        <tbody id="blog-posts-table">
                            <tr>
                                <td class="py-2 px-4 border-b">Title</td>
                                <td class="py-2 px-4 border-b">Description</td>
                                <td class="py-2 px-4 border-b">Tag</td>
                                <td class="py-2 px-4 border-b">Date</td>
                            </tr>
                            <!-- Blog posts will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Graph Section Placeholder -->
            <section class="bg-white p-6 rounded-lg shadow-lg mt-8">
                <h2 class="text-2xl font-bold mb-4">Analytics</h2>
                <div class="h-64 bg-gray-100 rounded-lg shadow-inner flex items-center justify-center">
                    <span class="text-gray-500">Graph Placeholder</span>
                </div>
            </section>
        </main>
    </div>

    <!-- JavaScript -->
    {{-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addBlogForm = document.getElementById("add-blog-form");
            const blogPostsTable = document.getElementById("blog-posts-table");

            const blogPosts = []; // This will hold the blog posts data

            addBlogForm.addEventListener("submit", (event) => {
                event.preventDefault();

                const title = document.getElementById("blog-title").value;
                const description = document.getElementById("blog-description").value;
                const image = document.getElementById("blog-image").value;
                const tag = document.getElementById("blog-tag").value;
                const date = new Date().toLocaleDateString();

                const newBlogPost = { title, description, image, tag, date };
                blogPosts.push(newBlogPost);
                addBlogPostToTable(newBlogPost);

                addBlogForm.reset();
            });

            function addBlogPostToTable(blogPost) {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td class="py-2 px-4 border-b">${blogPost.title}</td>
                    <td class="py-2 px-4 border-b">${blogPost.description}</td>
                    <td class="py-2 px-4 border-b">${blogPost.tag}</td>
                    <td class="py-2 px-4 border-b">${blogPost.date}</td>
                `;

                blogPostsTable.appendChild(row);
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const addTagForm = document.getElementById("add-tag-form");

            addTagForm.addEventListener("submit", (event) => {
                event.preventDefault();

                const tagName = document.getElementById("tag-name").value;

                // Add the new tag to your data storage or UI

                addTagForm.reset();
            });
        });
    </script> --}}
</body>
</html>
