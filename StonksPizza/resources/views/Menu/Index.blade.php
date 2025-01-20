<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizza Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
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
        <h1 class="text-4xl font-semibold text-center mb-6">Ons Pizza Menu</h1>

        @auth
            {{-- Als de gebruiker een admin-rol heeft --}}
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('pizza.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg mb-6 inline-block shadow-md hover:bg-blue-600 transition duration-300">
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
                                        <a href="{{ route('pizza.edit', $pizza) }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow-md hover:bg-yellow-600 transition duration-300">
                                            Bewerken
                                        </a>
                                        <form action="{{ route('pizza.destroy', $pizza) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded shadow-md hover:bg-red-600 transition duration-300">
                                                Verwijderen
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @elseif(auth()->user()->hasRole('user'))
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($pizzas as $pizza)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            <img src="{{ $pizza->image_url }}" alt="{{ $pizza->naam }}" class="w-full h-48 object-cover">
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
                        </div>
                    @endforeach
                </div>
            @endif

        @else
            <p class="text-center text-lg mt-10">
                <strong>Log in</strong> om het menu te bekijken.
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
