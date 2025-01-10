<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-yellow-500 text-white py-4 shadow">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold">Pizzeria</h1>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        <h2 class="text-2xl font-semibold mb-6">Create a New Pizza</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pizza.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="naam" class="block mb-1 font-semibold">Pizza Name</label>
                <input type="text" id="naam" name="naam" class="w-full px-4 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Select Pizza Size</label>
                <div class="flex items-center space-x-4">
                    <label>
                        <input type="radio" name="size" value="small" class="mr-1">
                        Small
                    </label>
                    <label>
                        <input type="radio" name="size" value="medium" class="mr-1" checked>
                        Medium
                    </label>
                    <label>
                        <input type="radio" name="size" value="large" class="mr-1">
                        Large
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Select Ingredients</label>
                @foreach($ingredients as $ingredient)
                    <div class="flex items-center mb-1">
                        <input type="checkbox" name="ingredienten[]" value="{{ $ingredient->id }}" class="mr-2">
                        <span>{{ $ingredient->naam }} ( &euro;{{ number_format($ingredient->price, 2, ',', '.') }} )</span>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create Pizza
            </button>
        </form>
    </main>

    <footer class="bg-gray-800 text-gray-200 text-center py-2">
        <p>&copy; 2024 Pizzeria. All Rights Reserved.
            <a href="#" class="text-yellow-500 hover:underline">Privacy Policy</a>
        </p>
    </footer>
</body>
</html>
