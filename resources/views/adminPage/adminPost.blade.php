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
    <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Sign Out</a>
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
              <th class="px-4 py-2">Order ID</th>
              <th class="px-4 py-2">Customer</th>
              <th class="px-4 py-2">Date</th>
              <th class="px-4 py-2">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user as $a)


            <tr>
              <td class="border px-4 py-2">{{$a->email}}</td>
              <td class="border px-4 py-2">John Doe</td>
              <td class="border px-4 py-2">2024-05-01</td>
              <td class="border px-4 py-2">Delivered</td>
            </tr>
            @endforeach
            <tr>
              <td class="border px-4 py-2">002</td>
              <td class="border px-4 py-2">Jane Smith</td>
              <td class="border px-4 py-2">2024-05-03</td>
              <td class="border px-4 py-2">Pending</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">003</td>
              <td class="border px-4 py-2">Mark Johnson</td>
              <td class="border px-4 py-2">2024-05-05</td>
              <td class="border px-4 py-2">Processing</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
