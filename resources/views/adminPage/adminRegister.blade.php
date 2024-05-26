<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Portal</title> <style>
    /* Global styles */
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", Helvetica Neue, sans-serif;
      margin: 0;
      padding: 0;
      display: flex; /* Center content vertically */
      justify-content: center;
      align-items: center;
      min-height: 100vh; /* Ensure full viewport height */
      background-color: #333333; /* Light gray background */
    }

    /* Form container */
    form {
      background-color: #fff; /* White form background */
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Input fields */
    input[type="email"],
    input[type="password"],
    input[type="text"] {
      width: 93%;
      padding: 15px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      font-size: 16px;
    }

    /* Submit button */
    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 15px 20px;
      background-color: #3498db; /* Blue button */
      color: #fff; /* White text */
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.2s ease-in-out;
    }

    input[type="submit"]:hover {
      background-color: #2980b9; /* Darker blue on hover */
    }
  </style>
</head>
<body>
  <form action="{{ route('ARegister') }}" method="post">
    <h1>Welcome Admin</h1>
    @csrf
    <input type="email" name="email" id="email" placeholder="Email">
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">
    <input type="submit" value="Register">
  </form>
</body>
</html>
