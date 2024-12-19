@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold mb-6">Pizza Menu</h1>

    {{-- Display success message if present --}}
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Button to add new pizza --}}
    <a href="{{ route('pizza.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Pizza</a>

    {{-- Table to display all pizzas --}}
    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Ingredients</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($pizzas as $pizza)
    <tr>
        <td class="border px-4 py-2">{{ $pizza->naam }}</td>
        <td class="border px-4 py-2">
            @foreach ($pizza->ingredienten as $ingredient)
                {{ $ingredient->naam }}@if(!$loop->last), @endif
            @endforeach
        </td>
        <td class="border px-4 py-2">{{ $pizza->prijs() }}</td>
        <td class="border px-4 py-2">
            <a href="{{ route('pizza.edit', $pizza) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
            <form action="{{ route('pizza.destroy', $pizza) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
@endsection
