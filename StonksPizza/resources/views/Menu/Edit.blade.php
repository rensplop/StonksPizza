<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizza Bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

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

        <form action="{{ route('pizza.update', $pizza->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow-md">
    @csrf
    @method('PUT')

    @if($pizza->image)
        <div class="mb-4">
            <p class="font-semibold mb-2">Huidige afbeelding:</p>
            <img 
                src="{{ asset('storage/' . $pizza->image) }}" 
                alt="Pizza afbeelding" 
                class="w-48 h-auto border rounded"
            >
        </div>
    @endif

    <div class="mb-4">
        <label for="image" class="block mb-1 font-semibold">Afbeelding bijwerken</label>
        <input 
            type="file" 
            id="image" 
            name="image" 
            class="w-full px-4 py-2 border rounded" 
            accept="image/*"
        >
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
