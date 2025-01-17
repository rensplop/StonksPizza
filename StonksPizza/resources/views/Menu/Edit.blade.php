<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-yellow-500 text-white py-4 shadow">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold">Edit Pizza</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Over ons</a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
                @auth
                @if(auth()->user()->hasRole('admin'))
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
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pizza.update', $pizza) }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="naam" class="block mb-1 font-semibold">Pizza Name</label>
                <input type="text" id="naam" name="naam"
                       class="w-full px-4 py-2 border rounded"
                       value="{{ $pizza->naam }}" required>
            </div>

            <div class="mb-4">
                <label for="ingredienten" class="block mb-1 font-semibold">Select Ingredients</label>
                <select id="ingredienten" name="ingredienten[]" class="w-full px-4 py-2 border rounded" multiple required>
                    @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}"
                            {{ in_array($ingredient->id, $pizza->ingredienten->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $ingredient->naam }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Update Pizza
            </button>
        </form>
    </main>

    <footer class="bg-gray-800 text-gray-200 text-center py-2">
        <p>&copy; 2024 Pizzeria. All Rights Reserved.</p>
    </footer>
</body>
</html>
