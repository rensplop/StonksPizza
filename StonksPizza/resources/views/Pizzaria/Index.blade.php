<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizzeria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

<header class="bg-yellow-500 text-white shadow-lg py-4 relative z-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ url('/') }}" class="text-2xl font-bold tracking-wide">Pizzeria</a>
            <nav class="hidden md:flex space-x-4">
                <a href="{{ route('menu.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Menu</a>
                <a href="{{ route('about.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Over ons</a>
                <a href="{{ route('contact.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Contact</a>
                @auth
                    @php
                        $hasBestelling = \App\Models\Bestelling::where('user_id', auth()->id())->exists();
                    @endphp
                    @if($hasBestelling)
                        <a href="{{ route('status.index') }}" class="hover:bg-yellow-600 px-3 py-2 rounded">Status</a>
                    @endif
                @endauth
            </nav>
        </div>
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

                        @php
                            $hasBestellingDrop = \App\Models\Bestelling::where('user_id', auth()->id())->exists();
                        @endphp
                        @if($hasBestellingDrop)
                            <a href="{{ route('status.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Status
                            </a>
                        @endif

                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">
                            Profiel
                        </a>

                        <form action="{{ route('logout') }}" method="GET">
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100">
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
            <img src="/Images/margherita.jpg" alt="Klassieke Margherita" class="w-full rounded-md mb-4" />
            <h3 class="text-xl font-semibold mb-2">Klassieke Margherita</h3>
            <p class="text-gray-600">Een tijdloze favoriet, belegd met verse tomaten, mozzarella en basilicum.</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
            <img src="/Images/pepperoni.webp" alt="Pepperoni Festijn" class="w-full rounded-md mb-4" />
            <h3 class="text-xl font-semibold mb-2">Pepperoni Festijn</h3>
            <p class="text-gray-600">Rijkelijk belegd met pittige pepperoni en smeuïge mozzarella.</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
            <img src="/Images/veggie.webp" alt="Veggie Genot" class="w-full rounded-md mb-4" />
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