<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Include Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Additional custom styles */
    /* You can add your own custom styles here */

  </style>
</head>
<body class="bg-gray-100">
  <div class="flex justify-between p-6 bg-white shadow-md">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <a href="{{route('Post')}} "class='px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600'> Add Post</a>
    <form action="{{route('LogoutFunc')}}" method="get">
        @csrf
            <input type="submit" value="Sign Out"class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
        </form>
  </div>

  <div class="flex flex-col md:flex-row gap-6 p-6">
    <div class="w-full md:w-1/3 bg-white rounded-md shadow-md p-6">
      <h2 class="text-xl font-semibold mb-4">Statistics</h2>
      <div class="flex items-center justify-between mb-4">
        <p>Total Users:</p>
        <span class="text-blue-500 font-semibold">100</span>
      </div>
      <div class="flex items-center justify-between mb-4">
        <p>Total Orders:</p>
        <span class="text-blue-500 font-semibold">500</span>
      </div>
      <div class="flex items-center justify-between mb-4">
        <p>Total Revenue:</p>
        <span class="text-blue-500 font-semibold">$10,000</span>
      </div>
    </div>

    <div class="w-full md:w-2/3 bg-white rounded-md shadow-md p-6">
      <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr>
              <th class="px-4 py-2">id</th>
              <th class="px-4 py-2">Email</th>
              <th class="px-4 py-2">Username</th>
              <th class="px-4 py-2">created at</th>
              <th class="px-4 py-2">Status</th>
              <th class="px-4 py-2">Delete</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($user as $a)


            <tr>
              <td class="border px-4 py-2">{{$a->id}}</td>
              <td class="border px-4 py-2">{{$a->email}}</td>
              <td class="border px-4 py-2">{{$a->username}}</td>
              <td class="border px-4 py-2">{{$a->created_at}}</td>
              <td class="border px-4 py-2">{{$a->isAdmin}}</td>
              <td class="border px-4 py-2">
              <form action="{{route('Delete',$a->id)}}" method="POST">
                @csrf
                <input type="submit" value="Delete" style="cursor: pointer">
              </form>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
