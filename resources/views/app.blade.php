<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelio – Travel Booking</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
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

        .hero {
            padding: 80px 0;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 48px;
            align-items: center;
        }

        .hero-copy {
            max-width: 560px;
        }

        .hero-title {
            font-size: clamp(2.75rem, 6vw, 4rem);
            line-height: 1.05;
            margin-bottom: 1.25rem;
            color: #111827;
        }

        .hero-text {
            font-size: 1.05rem;
            color: #4b5563;
            margin-bottom: 2rem;
            max-width: 520px;
        }

        .hero-image {
            min-height: 420px;
            border-radius: 28px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .section-gap {
            padding: 60px 0;
        }

        .section-gap-light {
            background: #f8fafc;
        }

        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .destination-carousel {
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            scroll-behavior: smooth;
            padding-bottom: 8px;
        }

        .destination-carousel::-webkit-scrollbar {
            display: none;
        }

        .carousel-item {
            display: inline-block;
            width: 210px;
            margin-right: 18px;
        }

        .carousel-card {
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .carousel-card__image {
            min-height: 140px;
            background-size: cover;
            background-position: center;
        }

        .carousel-card__body {
            padding: 1rem;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #d1d5db;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.1);
        }

        .carousel-nav.hidden {
            display: none;
        }

        @media (max-width: 900px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .hero-image {
                min-height: 320px;
            }

            .carousel-item {
                width: 200px;
            }
        }

        @media (max-width: 700px) {
            .container {
                padding: 0 20px;
            }

            .hero {
                padding: 56px 0;
            }

            .section-gap {
                padding: 48px 0;
            }
        }
    </style>
</head>
<body>
    @include('navbar')
    <main>
        @yield('content')
    </main>
</body>
</html>