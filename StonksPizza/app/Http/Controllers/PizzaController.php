<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::with('ingredienten')->get();
        $ingredients = Ingredient::all();

        // Points to resources/views/Menu/Index.blade.php
        return view('Menu.index', compact('pizzas', 'ingredients'));
        return view('Orders.index', compact('pizzas'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();

        // Points to resources/views/Menu/Create.blade.php
        return view('Menu.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'ingredienten' => 'required|array',
        ]);

        $pizza = Pizza::create(['naam' => $request->naam]);
        $pizza->ingredienten()->attach($request->ingredienten);

        // Redirect back to /menu
        return redirect()->route('menu.index')->with('success', 'Pizza created!');
    }

    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();

        // Points to resources/views/Menu/Edit.blade.php
        return view('Menu.edit', compact('pizza', 'ingredients'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'ingredienten' => 'required|array',
        ]);

        $pizza->update(['naam' => $request->naam]);
        $pizza->ingredienten()->sync($request->ingredienten);

        // Redirect back to /menu
        return redirect()->route('menu.index')->with('success', 'Pizza updated!');
    }

    public function destroy(Pizza $pizza)
    {
        $pizza->ingredienten()->detach();
        $pizza->delete();

        // Redirect back to /menu
        return redirect()->route('menu.index')->with('success', 'Pizza deleted!');
    }
}
