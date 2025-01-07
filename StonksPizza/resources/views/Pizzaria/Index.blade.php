<!DOCTYPE html>
<<<<<<< HEAD
<html lang="nl">
=======
<html lang="en">

>>>>>>> ee00d6486cbe3cbb1a436ea103b6c97f4bd3f7e8
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
<<<<<<< HEAD
<body class="bg-gray-50 text-gray-900 font-sans">
    <header class="bg-indigo-600 text-white shadow-lg">
        <nav class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-3xl font-bold">Stonks Pizza</h1>
            <ul class="flex space-x-6 text-lg">
                <li><a href="{{ route('about') }}" class="hover:underline">Over Ons</a></li>
                <li><a href="{{ route('menu') }}" class="hover:underline">Menu</a></li>
                <li><a href="{{ route('contact') }}" class="hover:underline">Contact</a></li>
                <li><a href="{{ route('order') }}" class="bg-yellow-400 text-indigo-800 px-4 py-2 rounded hover:bg-yellow-300 transition">Bestel</a></li>
            </ul>
        </nav>
=======

<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="#about" class="text-white hover:text-yellow-300 transition duration-300">About</a>
                <a href="#contact" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
            </nav>
        </div>
>>>>>>> ee00d6486cbe3cbb1a436ea103b6c97f4bd3f7e8
    </header>

    <main class="container mx-auto px-4 py-8">
        <section class="text-center py-12">
            <h2 class="text-4xl font-semibold mb-4">Heerlijke Pizza’s, Vers voor Jou</h2>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Welkom bij Stonks Pizza! Geniet van onze vers bereide pizza’s, gemaakt met de beste ingrediënten en met liefde gebakken. Proef de smaak van traditie in elke hap.</p>
            <div class="mt-6">
                <a href="{{ route('order') }}" class="bg-yellow-400 text-indigo-800 px-6 py-3 rounded-lg shadow-lg hover:bg-yellow-300 transition duration-300">Bestel Nu</a>
            </div>
        </section>

        <section id="menu" class="mt-12">
            <h3 class="text-3xl font-semibold text-center mb-6">Onze Favorieten</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('images/margherita.jpg') }}" alt="Klassieke Margherita" class="w-full rounded-md mb-4">
                    <h4 class="text-xl font-semibold mb-2">Klassieke Margherita</h4>
                    <p class="text-gray-700">Een tijdloze favoriet met verse tomaten, mozzarella en basilicum.</p>
                    <a href="{{ route('menu') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">Bekijk Meer</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('images/pepperoni.webp') }}" alt="Pepperoni Feast" class="w-full rounded-md mb-4">
                    <h4 class="text-xl font-semibold mb-2">Pepperoni Feast</h4>
                    <p class="text-gray-700">Volgeladen met pittige pepperoni en smeuïge mozzarella.</p>
                    <a href="{{ route('menu') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">Bekijk Meer</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('images/veggie.webp') }}" alt="Veggie Delight" class="w-full rounded-md mb-4">
                    <h4 class="text-xl font-semibold mb-2">Veggie Delight</h4>
                    <p class="text-gray-700">Een kleurrijke mix van verse groenten op een bedje van tomatensaus.</p>
                    <a href="{{ route('menu') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">Bekijk Meer</a>
                </div>
            </div>
        </section>

<<<<<<< HEAD
=======
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/margherita.jpg" alt="Classic Margherita" class="w-full rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Classic Margherita</h3>
                <p class="text-gray-600">A timeless favorite topped with fresh tomatoes, mozzarella, and basil.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/pepperoni.webp" alt="Pepperoni Feast" class="w-full rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Pepperoni Feast</h3>
                <p class="text-gray-600">Loaded with spicy pepperoni and gooey mozzarella cheese.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/veggie.webp" alt="Veggie Delight" class="w-full rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Veggie Delight</h3>
                <p class="text-gray-600">A colorful mix of fresh veggies on a bed of savory tomato sauce.</p>
            </div>
        </div>
>>>>>>> ee00d6486cbe3cbb1a436ea103b6c97f4bd3f7e8
    </main>

    <footer class="bg-gray-900 text-gray-400 text-center py-4 mt-8">
        <p>&copy; 2024 Stonks Pizza. Alle Rechten Voorbehouden. <a class="text-yellow-400 hover:underline">Privacybeleid</a></p>
    </footer>
</body>

</html>
