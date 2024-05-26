<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Post</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .modal-body {
            padding: 20px 0;
        }

        .modal-footer {
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: right;
        }

        /* Custom button styles */
        .custom-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #45a049;
        }

        /* Custom form input styles */
        .custom-input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex justify-center items-center">
    <form action="{{route('Posting')}}" method="post" id="myForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <input type="text" name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="img" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
            <input type="image" name="img" id="img" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
            <select name="category" id="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                @foreach ($Category as  $s)
                    <option value="{{$s->name}}">{{$s->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="button" onclick="openCategoryModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Category</button>
            <input type="submit" value="Post it" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </div>

    </form>

    <!-- Modal -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeCategoryModal()">&times;</span>
                <h2>Add New Category</h2>
            </div>
            <div class="modal-body">
                <form id="categoryForm" method="POST" action="{{route('NewCategory')}}">
                    @csrf
                    <label for="newCategory">New Category Name:</label>
                    <input type="text" id="newCategory" name="name" class="custom-input">
                    <div class="modal-footer">
                        <input type="submit" value="Add Category" class="custom-btn">
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('categoryModal');

        // When the user clicks the button, open the modal
        function openCategoryModal() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        function closeCategoryModal() {
            modal.style.display = "none";
        }


    </script>

</body>

</html>
