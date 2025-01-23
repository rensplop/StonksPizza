<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel Bewerken - Pizzeria</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-semibold text-center mb-8">Profiel Bewerken</h2>

            @if (session('status'))
                <div class="mb-4 text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Naam</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="block w-full px-4 py-3 border rounded-md focus:ring-yellow-500 focus:border-yellow-500" required />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="block w-full px-4 py-3 border rounded-md focus:ring-yellow-500 focus:border-yellow-500" required />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nieuw Wachtwoord (optioneel)</label>
                    <input id="password" type="password" name="password" class="block w-full px-4 py-3 border rounded-md focus:ring-yellow-500 focus:border-yellow-500" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Bevestig Wachtwoord</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="block w-full px-4 py-3 border rounded-md focus:ring-yellow-500 focus:border-yellow-500" />
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center mb-8">
                    <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Profiel Bijwerken
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>&copy; 2024 Pizzeria. Alle rechten voorbehouden. <a href="#" class="text-yellow-500 hover:underline">Privacybeleid</a></p>
    </footer>
</body>

</html>
