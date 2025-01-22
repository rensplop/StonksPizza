<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stonks Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        nav ul li a {
            transition: transform 0.3s ease-in-out;
        }

        nav ul li a:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
<header class="bg-yellow-500 text-white shadow-lg py-6">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
        <nav class="space-x-6">
            <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
            <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
            <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Over ons</a>
            <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
            @auth
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('medewerker'))
                    <a href="{{ route('voertuigen.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Voertuigen</a>
                @endif

                @php
                    $hasBestelling = \App\Models\Bestelling::where('user_id', auth()->id())->exists();
                @endphp

                @if($hasBestelling)
                    <a href="{{ route('status.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Status</a>
                @endif

                <a href="{{ route('dashboard') }}" class="text-white hover:text-yellow-300 transition duration-300">Account</a>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 transition duration-300">Inloggen</a>
            @endauth
        </nav>
    </div>
</header>


    <main class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold text-center mb-4">Heerlijke Pizza, Vers Gemaakt</h2>
        <p class="text-center text-lg text-gray-600 max-w-2xl mx-auto mb-6">
            Welkom bij onze Pizzeria! Geniet van onze vers bereide pizza's, gemaakt met de beste ingrediënten en heerlijk krokant gebakken. Proef de traditie in elke hap.
        </p>

        <div class="flex justify-center">
            <a 
                class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-red-600 transition duration-300 ease-in-out" 
                href="{{ route('bestellingen.index') }}"
            >
                Bestel Nu
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/margherita.jpg" alt="Classic Margherita" class="w-full rounded-md mb-4" />
                <h3 class="text-xl font-semibold mb-2">Klassieke Margherita</h3>
                <p class="text-gray-600">Een tijdloze favoriet, belegd met verse tomaten, mozzarella en basilicum.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/pepperoni.webp" alt="Pepperoni Feast" class="w-full rounded-md mb-4" />
                <h3 class="text-xl font-semibold mb-2">Pepperoni Festijn</h3>
                <p class="text-gray-600">Rijkelijk belegd met pittige pepperoni en smeuïge mozzarella.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/veggie.webp" alt="Veggie Delight" class="w-full rounded-md mb-4" />
                <h3 class="text-xl font-semibold mb-2">Veggie Genot</h3>
                <p class="text-gray-600">Een kleurrijke mix van verse groenten op een laag van smaakvolle tomatensaus.</p>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4 mt-8">
        <p>
            &copy; 2024 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
        </p>
    </footer>
</body>
</html>
