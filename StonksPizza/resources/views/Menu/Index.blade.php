<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizza Menu</title>
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
            <a href="{{ url('/') }}" class="text-2xl font-bold tracking-wide">
                Pizzeria
            </a>
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
    <h1 class="text-4xl font-semibold text-center mb-6">Ons Pizza Menu</h1>
    @auth
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('pizza.create') }}"
               class="bg-blue-500 text-white px-6 py-3 rounded-lg mb-6 inline-block shadow-md hover:bg-blue-600 transition duration-300">
                Nieuwe Pizza Toevoegen
            </a>
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Naam</th>
                            <th class="border px-4 py-2 text-left">Ingrediënten</th>
                            <th class="border px-4 py-2 text-left">Totale Prijs</th>
                            <th class="border px-4 py-2 text-left">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizzas as $pizza)
                            @php
                                $totalePrijs = $pizza->ingredienten->sum('prijs');
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $pizza->naam }}</td>
                                <td class="border px-4 py-2">
                                    @foreach ($pizza->ingredienten as $ingredient)
                                        {{ $ingredient->naam }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">
                                    &euro;{{ number_format($totalePrijs, 2, ',', '.') }}
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('pizza.edit', $pizza) }}"
                                       class="bg-yellow-500 text-white px-4 py-2 rounded shadow-md hover:bg-yellow-600 transition duration-300">
                                        Bewerken
                                    </a>
                                    <form action="{{ route('pizza.destroy', $pizza) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded shadow-md hover:bg-red-600 transition duration-300">
                                            Verwijderen
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(auth()->user()->hasRole('medewerker') || auth()->user()->hasRole('user'))
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($pizzas as $pizza)
                    <div class="relative bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img
                            src="{{ $pizza->image ? asset('storage/' . $pizza->image) : asset('fallback-afbeelding.png') }}"
                            alt="{{ $pizza->naam }}"
                            class="w-full h-48 object-cover"
                        />
                        <div class="p-4">
                            <h2 class="text-xl font-bold mb-2">{{ $pizza->naam }}</h2>
                            <p class="text-gray-600 mb-4">
                                Ingrediënten:
                                @foreach ($pizza->ingredienten as $ingredient)
                                    {{ $ingredient->naam }}@if(!$loop->last), @endif
                                @endforeach
                            </p>
                            <p class="text-lg font-semibold text-gray-800">
                                &euro;{{ number_format($pizza->ingredienten->sum('prijs'), 2, ',', '.') }}
                            </p>
                        </div>
                        <a href="{{ route('bestellingen.index') }}"
                           class="absolute bottom-2 right-2 text-gray-700 hover:text-gray-900"
                           title="Naar bestelpagina">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="w-8 h-8">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center mt-10">Je hebt geen toegang tot het menu.</p>
        @endif
    @else
        <p class="text-center text-lg mt-10">
            <a href="{{ route('login') }}" class="text-sm text-yellow-500 hover:underline text-xl">
                Log in
            </a>
            om het menu te bekijken.
        </p>
    @endauth
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif
</main>

<footer class="bg-gray-800 text-gray-400 text-center py-4">
    <p>
        &copy; 2024 Pizzeria. Alle rechten voorbehouden.
        <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
    </p>
</footer>
</body>
</html>
