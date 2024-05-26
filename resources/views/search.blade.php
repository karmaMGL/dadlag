<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b">
            <div class="container mx-auto flex justify-between items-center py-4">
                <div class="text-3xl font-bold text-gray-900">
                    NewsPortal
                </div>
                <nav class="space-x-4 text-gray-700">
                    <a href="index.html" class="hover:text-blue-500">Home</a>
                    <a href="article.html" class="hover:text-blue-500">View Articles</a>
                    <a href="admin.html" class="hover:text-blue-500">Admin Dashboard</a>
                </nav>
                <div>
                    <form action="{{route('search')}}" method="POST">
                        @csrf
                        <input type="text" name="name" id="name" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                    </form>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main class="container mx-auto mt-8 flex-1">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Filters Section -->
                <aside class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Filters</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="filter-tags" class="block text-sm font-medium text-gray-700">Tags</label>
                            <select id="filter-tags" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500">
                                <option value="">All Tags</option>
                                <option value="Technology">Technology</option>
                                <option value="Politics">Politics</option>
                                <option value="Health">Health</option>
                                <!-- Add more tags as needed -->
                            </select>
                        </div>
                        <div>
                            <label for="filter-sort" class="block text-sm font-medium text-gray-700">Sort By</label>
                            <select id="filter-sort" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500">
                                <option value="latest">Latest</option>
                                <option value="az">A-Z</option>
                            </select>
                        </div>
                        <div>
                            <label for="filter-search" class="block text-sm font-medium text-gray-700">Search</label>
                            <input type="text" id="filter-search" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500">
                        </div>
                        <button id="apply-filters" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Apply Filters</button>
                    </div>
                </aside>

                <!-- Search Results Section -->
                <section class="col-span-3 bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4">Search Results</h2>
                    <div id="results-container" class="space-y-4">
                        <!-- Search results will be dynamically added here -->
                        @if (!$data->isEmpty())
                            @foreach ($data as $each)
                                <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900">{{$each->Title}}</h3>
                                            <p class="text-gray-700 mt-2">{{substr($each->Description,0,15)}}...</p>
                                            <span class="text-gray-500 mt-2">{{$each->Category}}</span>
                                            <span class="text-gray-500 mt-2">{{$each->created_at}}</span>
                                        </div>
                                        <img src="{{asset( $each->ImgPath)}}" alt="Advances in AI" class="w-24 h-24 object-cover rounded-lg">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1>No results found :(</h1>
                        @endif




                    </div>


                </section>

            </div>
        </main>
    </div>

    <!-- JavaScript -->
    {{-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            const resultsContainer = document.getElementById("results-container");
            const filterTags = document.getElementById("filter-tags");
            const filterSort = document.getElementById("filter-sort");
            const filterSearch = document.getElementById("filter-search");
            const applyFiltersButton = document.getElementById("apply-filters");
            const globalSearch = document.getElementById("global-search");

            let articles = [
                { title: "Advances in AI", description: "AI is transforming the tech industry...", tag: "Technology", date: "2024-05-18", image: "https://via.placeholder.com/300x200" },
                { title: "Political Landscape 2024", description: "The political climate is shifting...", tag: "Politics", date: "2024-05-17", image: "https://via.placeholder.com/300x200" },
                { title: "Health Trends", description: "New health trends are emerging...", tag: "Health", date: "2024-05-16", image: "https://via.placeholder.com/300x200" },
                // Add more articles as needed
            ];

            function renderResults(filteredArticles) {
                resultsContainer.innerHTML = "";

                filteredArticles.forEach(article => {
                    const articleDiv = document.createElement("div");
                    articleDiv.className = "bg-gray-100 p-4 rounded-lg shadow-inner";
                    articleDiv.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">${article.title}</h3>
                                <p class="text-gray-700 mt-2">${article.description}</p>
                                <span class="text-gray-500 mt-2">${article.tag}</span>
                                <span class="text-gray-500 mt-2">${article.date}</span>
                            </div>
                            <img src="${article.image}" alt="${article.title}" class="w-24 h-24 object-cover rounded-lg">
                        </div>
                    `;
                    resultsContainer.appendChild(articleDiv);
                });
            }

            function filterArticles() {
                let filteredArticles = articles;

                const tag = filterTags.value;
                const sort = filterSort.value;
                const search = filterSearch.value.toLowerCase();

                if (tag) {
                    filteredArticles = filteredArticles.filter(article => article.tag === tag);
                }

                if (search) {
                    filteredArticles = filteredArticles.filter(article => article.title.toLowerCase().includes(search) || article.description.toLowerCase().includes(search));
                }

                if (sort === "latest") {
                    filteredArticles.sort((a, b) => new Date(b.date) - new Date(a.date));
                } else if (sort === "az") {
                    filteredArticles.sort((a, b) => a.title.localeCompare(b.title));
                }

                renderResults(filteredArticles);
            }

            applyFiltersButton.addEventListener("click", filterArticles);
            globalSearch.addEventListener("input", filterArticles);

            renderResults(articles); // Initial rendering
        });
    </script> --}}
</body>
</html>
