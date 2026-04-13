<!DOCTYPE html>
<html>
<head>
    <title>User Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 50px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        .error { color: red; font-size: 14px; }
        .link { text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h2 style="text-align: center;">User Sign Up</h2>

    @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>⚠ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/signup" method="POST">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter Name" required>

        <label>Email:</label>
        <input type="text" name="email" placeholder="Enter Email" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <button type="submit">Sign Up</button>
    </form>

    <div class="link">
        <p>Already have an account? <a href="/login">Login</a></p>
    </div>
</div>
</body>
</html>