<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pizzeria')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="/" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="#about" class="text-white hover:text-yellow-300 transition duration-300">About</a>
                <a href="#contact" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
            </nav>
        </div>
    </header>

    @yield('content')

    <footer class="bg-gray-800 text-gray-400 text-center py-4 mt-8">
        <p>&copy; 2024 Pizzeria. All Rights Reserved. <a href="#" class="text-yellow-500 hover:underline">Privacy Policy</a></p>
    </footer>
</body>
</html>
