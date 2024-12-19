<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Create Pizza</h1>
            <nav class="space-x-6">
                <a href="{{ route('pizzas.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Back to Menu</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold text-center mb-4">Create Your Own Pizza</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pizzas.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="naam" class="block text-gray-700">Pizza Name</label>
                <input type="text" name="naam" id="naam" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="ingredients" class="block text-gray-700">Select Ingredients</label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($ingredients as $ingredient)
                        <div class="flex items-center">
                            <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}" class="mr-2">
                            <label>{{ $ingredient->naam }} - ${{ number_format($ingredient->prijs, 2) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-600 transition duration-300">Create Pizza</button>
        </form>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4 mt-8">
        <p>&copy; 2024 Pizzeria. All Rights Reserved. <a href="#" class="text-yellow-500 hover:underline">Privacy Policy</a></p>
    </footer>
</body>
</html>
