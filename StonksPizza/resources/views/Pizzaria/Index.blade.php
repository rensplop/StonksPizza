<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-semibold text-center mb-4">Heerlijke Pizza, Vers Gemaakt</h2>
    <p class="text-center text-lg text-gray-600 max-w-2xl mx-auto mb-6">Welkom bij onze pizzeria! Geniet van onze vers gemaakte pizza's, bereid met de beste ingrediënten en perfect gebakken. Ervaar de smaak van traditie in elke hap.</p>

        <div class="flex justify-center">
            <a class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-red-600 transition duration-300 ease-in-out" href="{{ route('menu.index') }}">Order Now</a>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
            <img src="/Images/margherita.jpg" alt="Klassieke Margherita" class="w-full rounded-md mb-4">
            <h3 class="text-xl font-semibold mb-2">Klassieke Margherita</h3>
            <p class="text-gray-600">Een tijdloze favoriet met verse tomaten, mozzarella en basilicum.</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
            <img src="/Images/pepperoni.webp" alt="Pepperoni Festijn" class="w-full rounded-md mb-4">
            <h3 class="text-xl font-semibold mb-2">Pepperoni Festijn</h3>
            <p class="text-gray-600">Belegd met pittige pepperoni en smeuïge mozzarella kaas.</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
            <img src="/Images/veggie.webp" alt="Vegetarisch Genot" class="w-full rounded-md mb-4">
            <h3 class="text-xl font-semibold mb-2">Vegetarisch Genot</h3>
            <p class="text-gray-600">Een kleurrijke mix van verse groenten op een bed van smaakvolle tomatensaus.</p>
        </div>
    </div>
</main>

<footer class="bg-gray-800 text-gray-400 text-center py-4">
    <p>
        &copy; 2024 Pizzeria. Alle rechten voorbehouden.
        <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
    </p>
</footer>

</body>
</html>