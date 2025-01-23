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
    <header class="bg-yellow-500 text-white shadow-lg py-4 relative z-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ url('/') }}" class="text-2xl font-bold tracking-wide">Pizzeria</a>
            <nav class="hidden md:flex space-x-4">
                <a href="{{ route('menu.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Menu</a>
                <a href="{{ route('about.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Over ons</a>
                <a href="{{ route('contact.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Contact</a>
                @auth
                    @php
                        $hasBestelling = \App\Models\Bestelling::where('user_id', auth()->id())->exists();
                    @endphp
                    @if($hasBestelling)
                        <a href="{{ route('status.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Status</a>
                    @endif
                @endauth
            </nav>
        </div>
        <div class="flex items-center space-x-4">
            @auth
                <div class="relative group inline-block">
                    <button
                        class="inline-flex items-center space-x-2 focus:outline-none hover:bg-yellow-600 px-3 py-2 rounded transition"
                    >
                        <i class="fa-solid fa-user"></i>
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </button>
                    <div
                        class="absolute right-0 top-full w-48 bg-white text-gray-800 py-2 rounded shadow
                               opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto
                               transition z-50"
                    >
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('medewerker'))
                            <a href="{{ route('voertuigen.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Voertuigen
                            </a>
                        @endif

                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('medewerker.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Medewerkers
                            </a>
                        @endif

                        @php
                            $hasBestellingDrop = \App\Models\Bestelling::where('user_id', auth()->id())->exists();
                        @endphp
                        @if($hasBestellingDrop)
                            <a href="{{ route('status.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Status
                            </a>
                        @endif

                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">
                            Profiel
                        </a>

                        <form action="{{ route('logout') }}" method="GET">
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                Uitloggen
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">
                    Inloggen
                </a>
            @endauth
        </div>
    </div>
</header>

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
