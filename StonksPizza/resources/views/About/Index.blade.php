<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over ons – Pizzeria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

<header class="bg-yellow-500 text-white shadow-lg py-6 relative z-50">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
        <nav class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Home</a>
            <a href="{{ route('menu.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Menu</a>
            <a href="{{ route('about.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Over ons</a>
            <a href="{{ route('contact.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Contact</a>
            @auth
                @php
                    $hasBestelling = \App\Models\Bestelling::where('user_id', auth()->id())->exists();
                @endphp
                @if($hasBestelling)
                    <a href="{{ route('status.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">
                        Status
                    </a>
                @endif
            @endauth
        </nav>
        <div class="flex items-center space-x-4">
            @auth
                <div class="relative group inline-block">
                    <button
                        class="inline-flex items-center space-x-2 focus:outline-none hover:bg-yellow-600 px-3 py-2 rounded transition"
                    >
                        <i class="fa-solid fa-user"></i>
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </button>
                    <div
                        class="absolute right-0 top-full w-48 bg-white text-gray-800 py-2 rounded shadow
                               opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto
                               transition z-50"
                    >
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('medewerker'))
                            <a href="{{ route('voertuigen.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Voertuigen
                            </a>
                        @endif
                        @if($hasBestelling)
                            <a href="{{ route('status.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Status
                            </a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">
                            Profiel
                        </a>
                        <form action="{{ route('logout') }}" method="GET">
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                Uitloggen
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">
                    Inloggen
                </a>
            @endauth
        </div>
    </div>
</header>

<main class="container mx-auto px-4 py-8 flex-grow">
    <h2 class="text-3xl font-semibold mb-4">Over Onze Pizzeria</h2>
    <p class="text-lg text-gray-700 mb-6 leading-relaxed">
        Welkom bij onze pizzeria! Ons team heeft een passie voor het bereiden van verse, smaakvolle pizza’s.
        Met de beste ingrediënten en veel liefde in elke deegbodem zorgen we ervoor dat elke pizza
        een ware smaakbeleving wordt. Of je nu houdt van een klassieke Margherita, een pittige Pepperoni
        of een vegetarische variant vol groenten, bij ons vind je voor ieder wat wils.
    </p>

    <h3 class="text-2xl font-semibold mb-3">Onze Geschiedenis</h3>
    <p class="text-gray-700 mb-4">
        Onze pizzeria is in 2020 opgericht met als doel: het maken van hoogwaardige pizza’s
        op traditionele wijze, maar met een moderne twist. Wat begon als een klein familiebedrijf
        is inmiddels uitgegroeid tot een geliefde plek voor pizza-liefhebbers in de hele regio.
    </p>

    <h3 class="text-2xl font-semibold mb-3">Onze Kwaliteit</h3>
    <p class="text-gray-700 mb-6">
        Wij streven ernaar om alleen de beste en meest verse ingrediënten te gebruiken.
        Van lokale leveranciers tot zorgvuldig geselecteerde specerijen en kazen: elk onderdeel
        van de pizza’s wordt met zorg uitgekozen. Zo garanderen we smaakvolle gerechten van
        constante kwaliteit.
    </p>

    <div class="flex space-x-4">
        <a href="{{ route('menu.index') }}"
           class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-red-600 transition duration-300">
            Bekijk ons Menu
        </a>
        <a href="{{ url('/contact') }}"
           class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-600 transition duration-300">
            Neem contact op
        </a>
    </div>
</main>

<footer class="bg-gray-800 text-gray-400 text-center py-4">
    <p>
        &copy; 2024 Pizzeria. Alle Rechten Voorbehouden.
        <a href="#" class="text-yellow-500 hover:underline">Privacy Policy</a>
    </p>
</footer>
</body>
</html>
