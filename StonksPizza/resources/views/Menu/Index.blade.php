<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Ons Pizza Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <header class="bg-yellow-500 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold">Pizzeria</h1>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Ons Pizza Menu</h2>
            <a href="{{ route('pizza.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
               Nieuwe Pizza Toevoegen
            </a>
        </div>

        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Naam</th>
                    <th class="px-4 py-2">Ingrediënten</th>
                    <th class="px-4 py-2">Grootte</th>
                    <th class="px-4 py-2">Totale Prijs</th>
                    <th class="px-4 py-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pizzas as $pizza)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $pizza->naam }}</td>
                        <td class="px-4 py-2">
                            {{ $pizza->ingredienten->pluck('naam')->join(', ') }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $pizza->size ? $pizza->size->naam : 'Onbekend' }}
                        </td>
                        <td class="px-4 py-2">
                            €{{ number_format($pizza->totaal_prijs, 2, ',', '.') }}
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('pizza.edit', $pizza->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded">
                               Bewerken
                            </a>
                            <form action="{{ route('pizza.destroy', $pizza->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded"
                                        onclick="return confirm('Pizza verwijderen?')">
                                    Verwijderen
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
