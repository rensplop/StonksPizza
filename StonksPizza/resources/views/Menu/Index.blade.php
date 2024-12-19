@extends('layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold text-center mb-4">Our Delicious Menu</h2>
        <p class="text-center text-lg text-gray-600 max-w-2xl mx-auto mb-6">Explore our wide variety of pizzas, made with the freshest ingredients, and find your favorite pizza today!</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <!-- Classic Margherita Pizza -->
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/margherita.jpg" alt="Classic Margherita" class="w-full rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Classic Margherita</h3>
                <p class="text-gray-600">A timeless favorite topped with fresh tomatoes, mozzarella, and basil.</p>
            </div>
            
            <!-- Pepperoni Feast Pizza -->
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/pepperoni.webp" alt="Pepperoni Feast" class="w-full rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Pepperoni Feast</h3>
                <p class="text-gray-600">Loaded with spicy pepperoni and gooey mozzarella cheese.</p>
            </div>
            
            <!-- Veggie Delight Pizza -->
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transform hover:scale-105 transition duration-300">
                <img src="/Images/veggie.webp" alt="Veggie Delight" class="w-full rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Veggie Delight</h3>
                <p class="text-gray-600">A colorful mix of fresh veggies on a bed of savory tomato sauce.</p>
            </div>

            <!-- More pizzas can be added in a similar structure -->
        </div>
    </main>
@endsection
