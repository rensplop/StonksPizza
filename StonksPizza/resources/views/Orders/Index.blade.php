<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellingen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

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

<div class="container max-w-screen-xl mx-auto px-4">
    @auth
    <div class="p-6 rounded-lg">
    <h1 class="text-xl font-bold mb-4 text-center">My Order</h1>
    @foreach ($pizzas as $pizza)
        <div class="bg-white rounded-lg shadow-md p-4 flex justify-between items-center mb-4">
            <div>
                <h2 class="text-lg font-bold">{{ $pizza->naam }}</h2>
            </div>
            <div class="text-lg font-semibold text-gray-800">
                &euro;{{ number_format($pizza->prijs, 2, ',', '.') }}
            </div>
        </div>
    @endforeach
</div>
    @else
    <p class="text-center text-lg mt-10">
        <strong>Log in</strong> om het menu te bekijken.
    </p>
    @endauth
</div>

<footer class="bg-gray-800 text-gray-400 text-center py-4">
    <p>
            &copy; 2024 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
    </p>
</footer>

</body>
</html>