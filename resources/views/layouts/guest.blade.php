<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Vite --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style>
        body {

            font-family: 'Poppins', sans-serif;

            background:
                linear-gradient(rgba(0, 0, 0, .65), rgba(0, 0, 0, .65)),
                url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=2070&auto=format&fit=crop');

            background-size: cover;

            background-position: center;

            background-attachment: fixed;

            min-height: 100vh;

        }

        .auth-wrapper {

            min-height: calc(100vh - 90px);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 40px 20px;

        }

        .auth-card {

            width: 100%;

            max-width: 450px;

            background: rgba(255, 255, 255, 0.95);

            border-radius: 20px;

            padding: 40px;

            box-shadow: 0 10px 60px rgba(255, 193, 7, 0.4);

            backdrop-filter: blur(10px);

        }

        .auth-title {

            font-size: 32px;

            font-weight: 700;

            text-align: center;

            margin-bottom: 10px;

            color: #111;

        }

        .auth-subtitle {

            text-align: center;

            color: #777;

            margin-bottom: 30px;

            font-size: 14px;

        }

        .form-label {

            font-weight: 600;

            margin-bottom: 8px;

            color: #222;

        }

        .form-control {

            border-radius: 12px;

            padding: 12px 15px;

            border: 1px solid #ddd;

        }

        .form-control:focus {

            border-color: #ffc107;

            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.2);

        }

        .btn-auth {

            border-radius: 12px;

            padding: 12px;

            font-weight: 600;

            background: #ffc107;

            border: none;

            color: #111;

            transition: 0.3s;

        }

        .btn-auth:hover {

            background: #ffca2c;

            transform: translateY(-2px);

        }

        .input-group .btn {

            border-radius: 0 12px 12px 0;

        }

        .auth-card a {

            text-decoration: none;

        }

        .auth-card a:hover {

            text-decoration: underline;

        }
    </style>

</head>

<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Main Auth Area --}}
    <div class="container">

        <div class="auth-wrapper">

            <div class="auth-card">

                {{ $slot }}

            </div>

        </div>

    </div>

    {{-- Contact --}}
    @include('contact.index')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>