<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria - Inloggen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl font-bold tracking-wide">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="text-white hover:text-yellow-300 transition duration-300">About</a>
                <a href="{{ route('contact.index') }}" class="text-white hover:text-yellow-300 transition duration-300">Contact</a>
                <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 transition duration-300">Inloggen</a>
            </nav>
        </div>
    </header>
    <!-- /Header -->

    <main class="container mx-auto px-4 py-8 flex-grow">
        <h2 class="text-3xl font-semibold text-center mb-6">Inloggen</h2>
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block mb-2 font-medium text-gray-700">E-mailadres</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300"
                        placeholder="jouw@email.com"
                        required
                    >
                </div>

                <div>
                    <label for="password" class="block mb-2 font-medium text-gray-700">Wachtwoord</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300"
                        placeholder="********"
                        required
                    >
                </div>

                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="mr-2 h-4 w-4 text-yellow-500 focus:ring-yellow-400"
                    >
                    <label for="remember" class="text-gray-700">Onthoud mij</label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 transition duration-300"
                >
                    Inloggen
                </button>

                <div class="text-center mt-4">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Wachtwoord vergeten?</a>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>&copy; 2024 Pizzeria. Alle rechten voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacyverklaring</a>
        </p>
    </footer>

</body>
</html>
