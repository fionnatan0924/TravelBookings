<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelio  @yield('title', 'Travel Booking')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f7f7f8;
            color: #1f2937;
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 28px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            color: #6b7280;
            margin-bottom: 1.75rem;
            max-width: 640px;
        }

        .button,
        button {
            font: inherit;
            border: none;
            border-radius: 999px;
            padding: 0.95rem 1.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .button-primary {
            background: #111827;
            color: #ffffff;
        }

        .button-primary:hover {
            background: #111827;
            opacity: 0.92;
        }

        .button-muted {
            background: #f3f4f6;
            color: #111827;
            border: 1px solid #d1d5db;
        }

        .button-muted:hover {
            background: #e5e7eb;
        }

        .card,
        .panel {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.06);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        }

        .input-field {
            width: 100%;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid #d1d5db;
            background: #f8fafc;
            color: #111827;
        }

        /* Flash messages */
        .alert {
            padding: 1rem 1.2rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .alert-error { background: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }

        footer {
            text-align: center;
            padding: 2rem;
            color: #6c7e94;
            font-size: 0.8rem;
            background: white;
            margin-top: 3rem;
            border-top: 1px solid #eef2f8;
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('layouts.navbar')
    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fa-regular fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Travelio – Smart Travel Booking. All rights reserved.</p>
    </footer>
    @stack('scripts')
</body>
</html>