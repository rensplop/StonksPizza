<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pizzeria</title>
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

<body class="flex flex-col min-h-screen">
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

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-semibold text-center mb-8">Inloggen</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input id="email" type="email" name="email" class="block w-full px-4 py-3 border rounded-md focus:ring-yellow-500 focus:border-yellow-500" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Wachtwoord</label>
                    <input id="password" type="password" name="password" class="block w-full px-4 py-3 border rounded-md focus:ring-yellow-500 focus:border-yellow-500" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="block mb-6">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-400" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Onthoud mij</span>
                    </label>
                </div>

                <!-- Login Button and Forgot Password -->
                <div class="flex items-center justify-between mb-8">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-yellow-500 hover:underline">
                        Wachtwoord vergeten?
                    </a>
                    @endif

                <div class="text-center">
                    <p class="text-gray-600 mb-4">Heb je nog geen account? <a href="{{ route('register') }}" class="text-sm text-yellow-500 hover:underline">Registreer nu</a></p>
                    
                </div>

                    <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Inloggen
                    </button>
                </div>
            </form>

            <!-- Register Button -->

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>&copy; 2024 Pizzeria. All Rights Reserved. <a href="#" class="text-yellow-500 hover:underline">Privacy Policy</a></p>
    </footer>
</body>

</html>
