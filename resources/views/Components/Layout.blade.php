<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Mac and Gab</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Merriweather', serif;
            background-color: #EEEEEE;
            color: #333;
        }
        .navbar {
            background-color: #222831;
            padding: 20px;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #fff !important;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            font-size: 1.2rem;
            padding: 10px;
        }
        .navbar-toggler {
            background-color: #fff;
        }
        .hero-section {
            background-image: url('{{ asset('images/resto.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
            text-align: center;
            margin-bottom: 40px;
        }
        .hero-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.5rem;
        }
        .menu-item {
            background-color: #FCFAEE;
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-radius: 8px;
        }
        .menu-item:hover {
            transform: scale(1.05);
            background-color:#D6EFD8;
        }
        .menu-item h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        .menu-item p {
            font-size: 1.1rem;
        }
        .footer {
            background-color: #222831;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" style="width: 50px; height: 50px; margin-right: 15px;" />
                <a class="navbar-brand" href="{{ url('/') }}">Mac and Gab</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <div class="footer mt-5">
        <p>&copy; 2024 Mac and Gab. All Rights Reserved.</p>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
