<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel Bewerken - Pizzeria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Over ons</a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
                @auth
                    <a href="{{ route('profile.edit') }}" class="text-white hover:text-yellow-300 transition duration-300">Account</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 transition duration-300">Inloggen</a>
                @endauth
            </nav>
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
