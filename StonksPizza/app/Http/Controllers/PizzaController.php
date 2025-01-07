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
        $ingredients = Ingredient::all();  // Get all ingredients for selection
        return view('menu.create', compact('ingredients'));  // Updated to match the path
    }
    

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'naam' => 'required|string|max:255',
            'ingredienten' => 'required|array', // Ensure at least one ingredient is selected
        ]);
    
        // Create the new pizza
        $pizza = Pizza::create([
            'naam' => $request->naam
        ]);
    
        // Attach selected ingredients to the pizza
        $pizza->ingredienten()->attach($request->ingredienten);
    
        return redirect()->route('pizza.index')->with('success', 'Pizza created!');
    }
    

    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();  
        return view('pizza.edit', compact('pizza', 'ingredients'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'ingredienten' => 'required|array', 
        ]);

        $pizza->update([
            'naam' => $request->naam
        ]);

        $pizza->ingredienten()->sync($request->ingredienten);

        return redirect()->route('pizza.index')->with('success', 'Pizza updated!');
    }

    public function destroy(Pizza $pizza)
    {
        $pizza->ingredienten()->detach();

        $pizza->delete();

        return redirect()->route('pizza.index')->with('success', 'Pizza deleted!');
    }
}
