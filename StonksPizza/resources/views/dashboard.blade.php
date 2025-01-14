<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Vamp Carti Style</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1a1a1a; /* Dark background */
            color: #e1e1e1; /* Light grey text */
            font-family: 'Inter', sans-serif;
        }

        .header {
            background-color: #ff006e; /* Neon pink */
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.4);
        }

        nav a {
            text-transform: uppercase;
            font-weight: bold;
            transition: transform 0.3s ease-in-out, color 0.3s;
            color: #e1e1e1;
        }

        nav a:hover {
            color: #ff006e; /* Neon pink hover effect */
            transform: scale(1.1);
        }

        .neon-text {
            color: #ff006e;
            text-shadow: 0px 0px 10px rgba(255, 0, 110, 0.8), 0px 0px 30px rgba(255, 0, 110, 0.6);
        }

        .card {
            background: linear-gradient(135deg, #2d2d2d 0%, #0c0c0c 100%);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.7);
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 25px rgba(255, 0, 110, 0.8);
            transition: transform 0.3s ease-in-out;
        }

        .button {
            background-color: #ff006e; /* Neon pink */
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease-in-out;
        }

        .button:hover {
            background-color: #ff3385;
            transform: scale(1.05);
        }

        footer {
            background-color: #0c0c0c;
            color: #ff006e;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer-link {
            color: #ff006e;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .bg-dramatic {
            background: linear-gradient(135deg, rgba(255, 0, 110, 0.8), rgba(0, 0, 0, 0.9));
        }

        .neon-border {
            border: 2px solid #ff006e;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="header py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-extrabold tracking-widest neon-text">Vamp Carti</h1>
            <nav class="space-x-6 text-xl">
                <a href="{{ url('/') }}" class="hover:text-white transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="hover:text-white transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="hover:text-white transition duration-300">About</a>
                <a href="{{ route('contact.index') }}" class="hover:text-white transition duration-300">Contact</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition duration-300">Account</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-white transition duration-300">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dramatic text-white shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-3xl font-bold mb-4 neon-text">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="text-lg mb-6">Here is your account information:</p>

                    <!-- Account Details Card -->
                    <div class="card mb-6">
                        <h4 class="font-semibold text-lg neon-text mb-2">Account Details</h4>
                        <p><span class="font-medium">Name:</span> {{ Auth::user()->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ Auth::user()->email }}</p>
                        <p><span class="font-medium">Account Created:</span> {{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <!-- Edit Profile Button -->
                        <a href="{{ route('profile.edit') }}" class="button hover:bg-pink-600">
                            Edit Profile
                        </a>

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="button hover:bg-pink-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Vamp Carti. All Rights Reserved. <a href="#" class="footer-link">Privacy Policy</a></p>
    </footer>

</body>

</html>
