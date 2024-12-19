<!-- resources/views/menu/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create a New Pizza</h1>

    <form action="{{ route('pizza.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="naam" class="block text-sm font-medium text-gray-700">Pizza Name</label>
            <input type="text" name="naam" id="naam" class="mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="ingredienten" class="block text-sm font-medium text-gray-700">Ingredients</label>
            <select name="ingredienten[]" id="ingredienten" multiple class="mt-1 block w-full" required>
                @foreach ($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->naam }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Pizza</button>
    </form>
@endsection
