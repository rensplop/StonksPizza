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
            'naam'         => 'required|string|max:255',
            'size'         => 'required|in:small,medium,large', // of hoe je het wilt valideren
            'ingredienten' => 'required|array',
        ]);
    
        // Nieuwe pizza aanmaken met naam en grootte
        $pizza = Pizza::create([
            'naam' => $request->naam,
            'size' => $request->size,
        ]);
    
        // Koppel de ingrediënten
        $pizza->ingredienten()->attach($request->ingredienten);
    
        // Redirect
        return redirect()->route('menu.index')->with('success', 'Pizza created!');
    }
    
    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        return view('Menu.edit', compact('pizza', 'ingredients'));
    }
    
    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'naam'         => 'required|string|max:255',
            'size'         => 'required|in:small,medium,large',
            'ingredienten' => 'required|array',
        ]);
    
        $pizza->update([
            'naam' => $request->naam,
            'size' => $request->size,
        ]);
    
        $pizza->ingredienten()->sync($request->ingredienten);
    
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
