<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bestellen</title>
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
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        <h1 class="text-3xl font-bold mb-6">Bestellen</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            @foreach($pizzas as $pizza)
                @php
                    $prijs = $pizza->ingredienten ? $pizza->ingredienten->sum('prijs') : 0;
                @endphp
                <div class="bg-white rounded shadow p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $pizza->naam }}</h2>
                    <p class="text-gray-700 mb-2">
                        Ingrediënten:
                        @if($pizza->ingredienten && $pizza->ingredienten->count())
                            {{ $pizza->ingredienten->pluck('naam')->implode(', ') }}
                        @else
                            Geen
                        @endif
                    </p>
                    <p class="text-gray-800 font-semibold mb-3">
                        &euro;{{ number_format($prijs, 2, ',', '.') }}
                    </p>
                    <form action="{{ route('bestellingen.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pizza_id" value="{{ $pizza->id }}">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            + Toevoegen
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded shadow p-4">
            <h3 class="text-2xl font-semibold mb-4">Mijn bestelling</h3>
            @if($bestelling && $bestelling->bestelregels->count())
                <table class="min-w-full mb-4">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Pizza</th>
                            <th class="py-2 text-left">Aantal</th>
                            <th class="py-2 text-left">Afmeting</th>
                            <th class="py-2 text-left">Totaal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totaal = 0; @endphp
                        @foreach($bestelling->bestelregels as $regel)
                            @php
                                $pizzaPrijs = $regel->pizza->ingredienten
                                    ? $regel->pizza->ingredienten->sum('prijs')
                                    : 0;
                                $subtotaal  = $pizzaPrijs * $regel->aantal;
                                $totaal    += $subtotaal;
                            @endphp
                            <tr class="border-b">
                                <td class="py-2">{{ $regel->pizza->naam }}</td>
                                <td class="py-2">{{ $regel->aantal }}</td>
                                <td class="py-2">{{ $regel->afmeting }}</td>
                                <td class="py-2">&euro;{{ number_format($subtotaal, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-xl font-bold">
                    Totaal: &euro;{{ number_format($totaal, 2, ',', '.') }}
                </div>
                <p class="mt-2">Status: <strong>{{ $bestelling->status }}</strong></p>
            @else
                <p>Er zijn nog geen items aan je bestelling toegevoegd.</p>
            @endif
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>
            &copy; 2025 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
        </p>
    </footer>

</body>
</html>
