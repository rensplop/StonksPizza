<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Voertuig Aanmaken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

<header class="bg-yellow-500 text-white py-4 shadow">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold">Stonks Pizza</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Over ons</a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
                @auth
                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('voertuigen.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Voertuigen</a>
                <a href="{{ route('medewerkers.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Medewerkers</a>
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
    <h2 class="text-2xl font-semibold mb-6">Maak een nieuw voertuig aan</h2>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-2 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('voertuigen.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        
        <div class="mb-4">
            <label for="naam" class="block mb-1 font-semibold">Voertuignaam</label>
            <input type="text" id="naam" name="naam" class="w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="merk" class="block mb-1 font-semibold">Merk</label>
            <input type="text" id="merk" name="merk" class="w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="soort" class="block mb-1 font-semibold">Soort</label>
            <select id="soort" name="soort" class="w-full px-4 py-2 border rounded" required>
                <option value="">-- Kies een soort --</option>
                <option value="auto">Auto</option>
                <option value="fiets">Fiets</option>
                <option value="bestelbus">Bestelbus</option>
                <option value="brommer">Brommer</option>
            </select>
        </div>



        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Voertuig Aanmaken
        </button>
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
