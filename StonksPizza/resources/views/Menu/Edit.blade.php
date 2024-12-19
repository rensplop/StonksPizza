@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold mb-6">Edit Pizza</h1>

    <form action="{{ route('pizza.update', $pizza) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="naam" class="block">Pizza Name</label>
            <input type="text" id="naam" name="naam" class="w-full px-4 py-2 border" value="{{ $pizza->naam }}" required>
        </div>

        <div class="mb-4">
            <label for="ingredienten" class="block">Select Ingredients</label>
            <select id="ingredienten" name="ingredienten[]" class="w-full px-4 py-2 border" multiple required>
                @foreach ($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}" 
                        {{ in_array($ingredient->id, $pizza->ingredienten->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $ingredient->naam }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update Pizza</button>
    </form>
@endsection
