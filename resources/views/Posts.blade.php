<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dynamic Post</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
@foreach ($data as $one)
<div class="max-w-xl mx-auto p-8 bg-white rounded shadow-lg mt-8">
    <h2 class="text-2xl font-bold mb-4">{{$one->Title}}</h2>
    <p class="text-gray-700 mb-4">{{$one->Description}}</p>
    <img class="w-full h-auto mb-4" src="{{Storage::url($one->ImgPath) }}" alt="Post Image">
    <p class="text-sm text-gray-600 mb-2">Category: <span class="text-blue-500 font-semibold">{{$one->Category}}</span></p>
    <div class="comments-section mb-8">
        <h3 class="text-lg font-semibold mb-2">Comments</h3>

        @foreach ($comments as $comment)
            @if ($comment->PostId == $one->id)
                <div class="comment mb-4">
                    <p class="text-gray-700 mb-1">{{$comment->Comment}}</p>
                    <p class="text-sm text-gray-600">Comment by: {{$comment->ByWho}}</p>
                </div>
            @endif
        @endforeach

        <!-- More comments can be dynamically added here -->
    </div>
    <form class="mb-4" method="POST" action="{{route('Comment',$one->id)}}">
        @csrf
        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700">Your Comment:</label>
            <textarea id="comment" name="comment" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Submit Comment</button>
    </form>
</div>
@endforeach
</body>
</html>
