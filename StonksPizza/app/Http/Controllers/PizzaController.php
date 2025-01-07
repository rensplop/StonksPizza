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

        return view('menu.index', compact('pizzas', 'ingredients'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();  
        return view('menu.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'naam'         => 'required|string|max:255',
            'ingredienten' => 'required|array',
        ]);

        // Create the new pizza
        $pizza = Pizza::create([
            'naam' => $request->naam
        ]);

        // Attach selected ingredients to the pizza
        $pizza->ingredienten()->attach($request->ingredienten);

        // Redirect to the “menu.index” route (where the user sees the list of pizzas)
        return redirect()->route('menu.index')
                         ->with('success', 'Pizza created!');
    }

    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        return view('pizza.edit', compact('pizza', 'ingredients'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'naam'         => 'required|string|max:255',
            'ingredienten' => 'required|array',
        ]);

        $pizza->update([
            'naam' => $request->naam
        ]);

        // Sync the selected ingredients
        $pizza->ingredienten()->sync($request->ingredienten);

        // Redirect to “menu.index”
        return redirect()->route('menu.index')
                         ->with('success', 'Pizza updated!');
    }

    public function destroy(Pizza $pizza)
    {
        // Detach all ingredients first
        $pizza->ingredienten()->detach();

        // Then delete the pizza record
        $pizza->delete();

        // Redirect to “menu.index”
        return redirect()->route('menu.index')
                         ->with('success', 'Pizza deleted!');
    }
}
