<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizza Bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-yellow-500 text-white py-4 shadow">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Over ons</a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-yellow-300 transition duration-300">Account</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 transition duration-300">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        <h2 class="text-2xl font-semibold mb-6">Pizza bewerken</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pizza.update', $pizza->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="naam" class="block mb-1 font-semibold">Naam van de Pizza</label>
                <input type="text" id="naam" name="naam"
                       class="w-full px-4 py-2 border rounded"
                       value="{{ old('naam', $pizza->naam) }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Selecteer de grootte</label>
                <div class="flex items-center space-x-4">
                @foreach ($sizes as $size)
    <label>
        <input type="radio"
               name="size_id"
               value="{{ $size->id }}"
               {{ old('size_id', $pizza->size_id) == $size->id ? 'checked' : '' }}>
        {{ $size->naam }}
    </label>
@endforeach

                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Selecteer ingrediënten</label>
                @foreach ($ingredients as $ingredient)
                    <div class="flex items-center mb-1">
                        <input type="checkbox"
                               name="ingredienten[]"
                               value="{{ $ingredient->id }}"
                               class="mr-2"
                               {{ $pizza->ingredienten->contains($ingredient->id) ? 'checked' : '' }}>
                        <span>
                            {{ $ingredient->naam }}
                            (&euro;{{ number_format($ingredient->prijs, 2, ',', '.') }})
                        </span>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Pizza Bijwerken
            </button>
        </form>
    </main>

    <footer class="bg-gray-800 text-gray-200 text-center py-2">
        <p>&copy; 2024 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
        </p>
    </footer>
</body>
</html>
