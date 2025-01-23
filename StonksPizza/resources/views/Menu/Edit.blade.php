<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizza Bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

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

                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('medewerker.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Medewerkers
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
    <h2 class="text-2xl font-semibold mb-6">Pizza bewerken</h2>
    @if (session('success'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-500 text-white p-2 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('pizza.update', $pizza->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow-md"
    >
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="naam" class="block mb-1 font-semibold">Naam van de Pizza</label>
            <input
                type="text"
                id="naam"
                name="naam"
                class="w-full px-4 py-2 border rounded"
                value="{{ old('naam', $pizza->naam) }}"
                required
            >
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Selecteer de grootte</label>
            <div class="flex items-center space-x-4">
                @foreach ($sizes as $size)
                    <label>
                        <input
                            type="radio"
                            name="size_id"
                            value="{{ $size->id }}"
                            {{ old('size_id', $pizza->size_id) == $size->id ? 'checked' : '' }}
                        >
                        {{ $size->naam }}
                    </label>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Selecteer ingrediënten</label>
            @foreach ($ingredients as $ingredient)
                <div class="flex items-center mb-1">
                    <input
                        type="checkbox"
                        name="ingredienten[]"
                        value="{{ $ingredient->id }}"
                        class="mr-2"
                        {{ $pizza->ingredienten->contains($ingredient->id) ? 'checked' : '' }}
                    >
                    <span>
                        {{ $ingredient->naam }} (&euro;{{ number_format($ingredient->prijs, 2, ',', '.') }})
                    </span>
                </div>
            @endforeach
        </div>
        @if($pizza->image)
            <div class="mb-4">
                <p class="font-semibold mb-2">Huidige afbeelding:</p>
                <img
                    src="{{ asset('storage/' . $pizza->image) }}"
                    alt="Pizza afbeelding"
                    class="w-48 h-auto border rounded"
                >
            </div>
        @endif
        <div class="mb-4">
            <label for="image" class="block mb-1 font-semibold">Afbeelding</label>
            <input
                type="file"
                id="image"
                name="image"
                class="w-full px-4 py-2 border rounded"
                accept="image/*"
            >
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Pizza Bijwerken
        </button>
    </form>
</main>

<footer class="bg-gray-800 text-gray-200 text-center py-2">
    <p>
        &copy; 2024 Pizzeria. Alle rechten voorbehouden.
        <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
    </p>
</footer>
</body>
</html>
