<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizza Bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
    <header class="bg-yellow-500 text-white py-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('menu.index') }}">Menu</a>
                <a href="{{ route('about.index') }}">Over ons</a>
                <a href="{{ route('contact.index') }}">Contact</a>
                <a href="{{ route('voertuigen.index') }}">Voertuigen</a>
                <a href="{{ route('mylogin.index') }}">Inloggen</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        <h2 class="text-2xl font-semibold mb-6">Bewerk de Pizza</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pizza.update', $pizza->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="naam" class="block mb-1 font-semibold">Naam van de Pizza</label>
                <input
                    type="text"
                    id="naam"
                    name="naam"
                    class="w-full px-4 py-2 border rounded"
                    value="{{ old('naam', $pizza->naam) }}"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Selecteer de grootte</label>
                <div class="flex items-center space-x-4">
                    <label>
                        <input type="radio" name="size" value="small"
                               {{ (old('size', $pizza->size) == 'small') ? 'checked' : '' }}>
                        Small
                    </label>
                    <label>
                        <input type="radio" name="size" value="medium"
                               {{ (old('size', $pizza->size) == 'medium') ? 'checked' : '' }}>
                        Medium
                    </label>
                    <label>
                        <input type="radio" name="size" value="large"
                               {{ (old('size', $pizza->size) == 'large') ? 'checked' : '' }}>
                        Large
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Selecteer ingrediënten</label>
                @foreach($ingredients as $ingredient)
                    <div class="flex items-center mb-1">
                        <input
                            type="checkbox"
                            name="ingredienten[]"
                            value="{{ $ingredient->id }}"
                            class="mr-2"
                            {{ in_array($ingredient->id, $pizza->ingredienten->pluck('id')->toArray()) ? 'checked' : '' }}
                        >
                        <span>{{ $ingredient->naam }} (&euro;{{ number_format($ingredient->price, 2, ',', '.') }})</span>
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
