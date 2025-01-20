<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Voertuigen Beheren</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria - Voertuigen</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                @auth
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('medewerker'))
                        <a href="{{ route('voertuigen.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Voertuigen</a>
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

    <main class="container mx-auto px-4 py-8 flex-grow">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->hasRole('admin'))
            <h1 class="text-4xl font-semibold text-center mb-6">Bestelvoertuigen Beheren</h1>
            <a href="{{ route('voertuigen.create') }}"
               class="bg-blue-500 text-white px-6 py-3 rounded-lg mb-6 inline-block shadow-md hover:bg-blue-600 transition duration-300">
                Nieuw Voertuig Toevoegen
            </a>
        @elseif(auth()->user()->hasRole('medewerker'))
            <h1 class="text-4xl font-semibold text-center mb-6">Overzicht Bestelvoertuigen (Alleen-lezen)</h1>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($voertuigen as $voertuig)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-4">
                        <h2 class="text-xl font-bold mb-2">{{ $voertuig->naam }}</h2>
                        <p class="text-gray-600 mb-2">
                            <span class="font-semibold">Merk:</span> {{ $voertuig->merk }}
                        </p>
                        <p class="text-gray-600 mb-4">
                            <span class="font-semibold">Soort:</span> {{ $voertuig->soort }}
                        </p>

                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('voertuigen.edit', $voertuig->id) }}"
                               class="inline-block bg-yellow-500 text-white px-4 py-2 rounded shadow-md hover:bg-yellow-600 transition duration-300">
                                Bewerken
                            </a>
                            <form action="{{ route('voertuigen.destroy', $voertuig->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded shadow-md hover:bg-red-600 transition duration-300"
                                        onclick="return confirm('Weet je zeker dat je dit voertuig wilt verwijderen?')">
                                    Verwijderen
                                </button>
                            </form>
                        @elseif(auth()->user()->hasRole('medewerker'))
                            <span class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded shadow-md">Alleen-lezen</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>
            &copy; 2025 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
        </p>
    </footer>
</body>
</html>
