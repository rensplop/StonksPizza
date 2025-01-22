<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizzeria Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">Pizzeria Status</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300">Menu</a>
                <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300">Over ons</a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300">Contact</a>
                @auth
                    @if(auth()->user()->hasRole('medewerker') || auth()->user()->hasRole('admin'))
                        <a href="{{ route('voertuigen.index') }}" class="text-white hover:text-yellow-300">Voertuigen</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @auth
            @if(auth()->user()->hasRole('medewerker') || auth()->user()->hasRole('admin'))
                <h2 class="text-2xl font-bold mb-4">Alle Bestellingen (Medewerker/Admin)</h2>
                @if(!empty($alleBestellingen) && count($alleBestellingen) > 0)
                    <table class="min-w-full bg-white rounded shadow">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Bestelregels</th>
                                <th class="px-4 py-2 text-left">Wijzig Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alleBestellingen as $b)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $b->id }}</td>
                                    <td class="px-4 py-2">{{ $b->status }}</td>
                                    <td class="px-4 py-2">
                                        @foreach($b->bestelregels as $regel)
                                            {{ $regel->pizza->naam }} (x{{ $regel->aantal }})<br>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('status.updateStatus', $b->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="border rounded p-1 mr-2">
                                                <option value="besteld" @selected($b->status=='besteld')>Besteld</option>
                                                <option value="in voorbereiding" @selected($b->status=='in voorbereiding')>
                                                    In voorbereiding
                                                </option>
                                                <option value="in oven" @selected($b->status=='in oven')>In oven</option>
                                                <option value="klaar" @selected($b->status=='klaar')>Klaar</option>
                                                <option value="geannuleerd" @selected($b->status=='geannuleerd')>
                                                    Geannuleerd
                                                </option>
                                            </select>
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                                Wijzig
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Geen bestellingen gevonden.</p>
                @endif
            @else
                <h2 class="text-2xl font-bold mb-4">Mijn Bestelling (Klant)</h2>
                @if($bestelling)
                    <div class="bg-white rounded shadow p-4">
                        <p class="mb-2"><strong>Bestelling ID:</strong> {{ $bestelling->id }}</p>
                        <p class="mb-2"><strong>Huidige status:</strong> {{ $bestelling->status }}</p>
                        <h3 class="font-semibold text-lg mb-2">Bestelregels:</h3>
                        <ul class="list-disc ml-5">
                            @foreach($bestelling->bestelregels as $regel)
                                <li>{{ $regel->pizza->naam }} (x{{ $regel->aantal }})</li>
                            @endforeach
                        </ul>
                        <div class="mt-4">
                            <form action="{{ route('status.annuleer', $bestelling->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                    Annuleer Bestelling
                                </button>
                            </form>
                        </div>
                        <div class="mt-4">
                            <p class="italic text-gray-600">
                                Voortgang:
                                @if($bestelling->status == 'in voorbereiding')
                                    Pizza wordt nu bereid...
                                @elseif($bestelling->status == 'in oven')
                                    Pizza is in de oven...
                                @elseif($bestelling->status == 'klaar')
                                    Pizza is klaar!
                                @elseif($bestelling->status == 'geannuleerd')
                                    Bestelling geannuleerd.
                                @else
                                    Bestelling staat op {{ $bestelling->status }}.
                                @endif
                            </p>
                        </div>
                    </div>
                @else
                    <p>Je hebt momenteel geen actieve bestelling.</p>
                @endif
            @endif
        @else
            <p>Je bent niet ingelogd.</p>
        @endauth
    </main>

    <footer class="bg-gray-800 text-gray-200 text-center py-2">
        <p>
            &copy; 2025 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
        </p>
    </footer>
</body>
</html>
