@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow">
            <h1 class="text-4xl font-semibold text-center mb-6">Pizza Menu</h1>

            {{-- Display success message if present --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Button to add new pizza --}}
            <a href="{{ route('pizza.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg mb-6 inline-block shadow-md hover:bg-blue-600 transition duration-300">Add New Pizza</a>

            {{-- Table to display all pizzas --}}
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Name</th>
                            <th class="border px-4 py-2 text-left">Ingredients</th>
                            <th class="border px-4 py-2 text-left">Price</th>
                            <th class="border px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizzas as $pizza)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $pizza->naam }}</td>
                                <td class="border px-4 py-2">
                                    @foreach ($pizza->ingredienten as $ingredient)
                                        {{ $ingredient->naam }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">{{ $pizza->prijs() }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('pizza.edit', $pizza) }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow-md hover:bg-yellow-600 transition duration-300">Edit</a>
                                    <form action="{{ route('pizza.destroy', $pizza) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded shadow-md hover:bg-red-600 transition duration-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="bg-gray-800 text-gray-400 text-center py-4 mt-8">
            <p>&copy; 2024 Pizzeria. All Rights Reserved. <a href="#" class="text-yellow-500 hover:underline">Privacy Policy</a></p>
        </footer>
    </div>
@endsection
