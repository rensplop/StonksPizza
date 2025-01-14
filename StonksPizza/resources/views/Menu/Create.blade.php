<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Pizza Aanmaken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-yellow-500 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold">Pizzeria</h1>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pizza.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="mb-4">
                <label for="naam" class="block mb-1 font-semibold">Naam</label>
                <input type="text" name="naam" id="naam" class="w-full p-2 border rounded"
                       value="{{ old('naam') }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Grootte</label>
                <div class="flex flex-wrap gap-4">
                    @foreach($sizes as $size)
                        <label class="flex items-center">
                            <input type="radio" name="size_id" class="mr-2"
                                   value="{{ $size->id }}"
                                   {{ old('size_id') == $size->id ? 'checked' : '' }}>
                            {{ $size->naam }}
                            @if($size->price)
                                ( €{{ number_format($size->price, 2, ',', '.') }} )
                            @endif
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Ingrediënten</label>
                @foreach($ingredients as $ingredient)
                    <div class="flex items-center mb-1">
                        <input type="checkbox" name="ingredienten[]" class="mr-2"
                               value="{{ $ingredient->id }}"
                               {{ is_array(old('ingredienten')) && in_array($ingredient->id, old('ingredienten')) ? 'checked' : '' }}>
                        {{ $ingredient->naam }}
                        @if($ingredient->price)
                            ( €{{ number_format($ingredient->price, 2, ',', '.') }} )
                        @endif
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Pizza Aanmaken
            </button>
        </form>
    </main>
</body>
</html>
