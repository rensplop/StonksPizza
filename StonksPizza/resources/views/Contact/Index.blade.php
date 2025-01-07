<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Contact – Pizzeria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">
    <header class="bg-yellow-500 text-white shadow-lg py-6">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-3xl font-bold">Pizzeria</h1>
            <nav class="space-x-6">
                <a href="{{ url('/') }}" class="hover:text-yellow-300 transition duration-300">Home</a>
                <a href="{{ route('menu.index') }}" class="hover:text-yellow-300 transition duration-300">Menu</a>
                <a href="{{ route('about.index') }}" class="hover:text-yellow-300 transition duration-300">Over ons</a>
                <a href="{{ url('/contact') }}" class="hover:text-yellow-300 transition duration-300">Contact</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12 flex-grow">
        <h2 class="text-4xl font-semibold mb-4 text-center">Neem contact met ons op</h2>
        <p class="text-lg text-center text-gray-700 max-w-2xl mx-auto mb-8 leading-relaxed">
            Heb je vragen over onze pizza’s, wil je een bestelling plaatsen of heb je andere opmerkingen?
            We helpen je graag verder! Je kunt ons bereiken via onderstaande gegevens of rechtstreeks
            een bezoekje brengen aan onze pizzeria.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">Adres &amp; Telefoon</h3>
                <p class="text-gray-700 mb-2">
                    <strong>Adres:</strong> Pizza Street 123, 10001 New York, USA
                </p>
                <p class="text-gray-700 mb-2">
                    <strong>Telefoon:</strong> +1 555-1234
                </p>
                <p class="text-gray-700 mb-6">
                    <strong>E-mail:</strong> bobboontjes@gmail.com
                </p>
                
                <h3 class="text-2xl font-semibold mb-4">Openingstijden</h3>
                <ul class="text-gray-700 space-y-1">
                    <li>Ma - Vr: 12:00 - 22:00</li>
                    <li>Za - Zo: 14:00 - 00:00</li>
                </ul>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">Locatie op Google Maps</h3>
                <div class="w-full h-64 relative overflow-hidden rounded">
                    <iframe
                        class="absolute top-0 left-0 w-full h-full border-0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.7526926125154!2d-73.99730918459376!3d40.74592887932815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259afef7aa555%3A0xc796fe60263b0e09!2sNY%20Pizza%20Suprema!5e0!3m2!1sen!2snl!4v1681234567890!5m2!1sen!2snl"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center py-4">
        <p>
            &copy; 2024 Pizzeria. Alle Rechten Voorbehouden.
            <a href="#" class="text-yellow-500 hover:underline">Privacy Policy</a>
        </p>
    </footer>
</body>
</html>
