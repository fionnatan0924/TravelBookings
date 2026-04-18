@if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!DOCTYPE html>
<html>
<head>
    <title>User Sign Up - Travelio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fc 0%, #eef2f8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: #ffffff;
            border-radius: 2rem;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            background: linear-gradient(135deg, #1f3b4c, #2c6e9e);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
        }

        label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5b7e9c;
            display: block;
            margin-bottom: 0.4rem;
        }

        input {
            width: 100%;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            transition: all 0.2s;
            outline: none;
            color: #1e2f3e;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        input:focus {
            border-color: #2c6e9e;
            box-shadow: 0 0 0 3px rgba(44, 110, 158, 0.08);
        }

        button {
            width: 100%;
            background: linear-gradient(105deg, #0f2b3d, #1f4b6e);
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 0.5rem;
        }

        button:hover {
            transform: translateY(-2px);
            background: linear-gradient(105deg, #1a3a52, #28638b);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Error alert styles (matching combo page) */
        .alert-error {
            background: #fef2f2;
            border-left: 4px solid #e53e3e;
            border-radius: 1rem;
            padding: 0.8rem 1rem;
            margin-bottom: 1.5rem;
        }
        .alert-error ul {
            margin: 0;
            padding-left: 1.2rem;
            color: #e53e3e;
            font-size: 0.8rem;
        }

        .link {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.85rem;
            color: #6c7e94;
        }

        .link a {
            color: #1f4b6e;
            text-decoration: none;
            font-weight: 600;
        }

        .link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            body { padding: 1rem; }
            .container { padding: 1.5rem; }
            h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2><i class="fa-regular fa-user-plus"></i> User Sign Up</h2>

    <form action="/signup" method="POST">
        @csrf

        <label>Full Name</label>
        <input type="text" name="name" placeholder="e.g., John Doe" required>

        <label>Email Address</label>
        <input type="email" name="email" placeholder="you@example.com" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Sign Up <i class="fa-solid fa-arrow-right"></i></button>
    </form>

    <div class="link">
        <p>Already have an account? <a href="/login">Log in</a></p>
    </div>
</div>
</body>
</html>