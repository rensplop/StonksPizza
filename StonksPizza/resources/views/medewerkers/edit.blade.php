<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Medewerker Bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">
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

    <main class="container mx-auto px-4 py-8 flex-grow">
        <h1 class="text-4xl font-semibold text-center mb-6">Medewerker Bewerken</h1>

        <form action="{{ route('medewerkers.update', $medewerker) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="naam" class="block text-gray-700 font-bold mb-2">Naam</label>
                <input type="text" name="naam" id="naam" value="{{ old('naam', $medewerker->naam) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $medewerker->email) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Bijwerken</button>
            </div>
        </form>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>
            &copy; 2024 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
        </p>
    </footer>
</body>
</html>
