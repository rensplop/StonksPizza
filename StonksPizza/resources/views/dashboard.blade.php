<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pizzeria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        nav ul li a {
            transition: transform 0.3s ease-in-out;
        }

        nav ul li a:hover {
            transform: translateY(-5px);
        }
        body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
        }   

        main {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Over ons</a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
                @auth
                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('voertuigen.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Voertuigen</a>
                <a href="{{ route('medewerkers.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Medewerkers</a>
                @endif
                @endauth
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-yellow-300 transition duration-300">Account</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 transition duration-300">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
    @auth
    @if(auth()->user()->hasRole('admin'))
        <p>Welkom, Admin!</p>
    @elseif(auth()->user()->hasRole('user'))
        <p>Welkom, Gebruiker!</p>
    @endif
@endauth

        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-semibold text-center mb-8">Welkom, {{ Auth::user()->name }}!</h2>

            <div class="mb-6">
                <p class="text-sm font-medium text-gray-700 mb-2">Naam:</p>
                <p class="text-lg text-gray-800">{{ Auth::user()->name }}</p>
            </div>

            <div class="mb-6">
                <p class="text-sm font-medium text-gray-700 mb-2">E-mail:</p>
                <p class="text-lg text-gray-800">{{ Auth::user()->email }}</p>
            </div>

            <div class="mb-6">
                <p class="text-sm font-medium text-gray-700 mb-2">Account aangemaakt:</p>
                <p class="text-lg text-gray-800">{{ Auth::user()->created_at->format('d M Y') }}</p>
            </div>

            <div class="flex items-center justify-between mt-8">
                <a href="{{ route('profile.edit') }}" class="bg-yellow-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Profiel bewerken
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Uitloggen
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>&copy; 2024 Pizzeria. Alle rechten voorbehouden. <a href="#" class="text-yellow-500 hover:underline">Privacybeleid</a></p>
    </footer>

</body>

</html>
