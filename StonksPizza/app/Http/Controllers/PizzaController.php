<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\Size;


class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::with('ingredienten')->get();
        $ingredients = Ingredient::all();

        return view('Menu.index', compact('pizzas', 'ingredients'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();
        $sizes = Size::all(); 
    
        return view('Menu.create', compact('ingredients', 'sizes'));
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'naam'         => 'required|string|max:255',
            'size_id'      => 'required|exists:sizes,id', 
            'ingredienten' => 'required|array',
        ]);
    
        $pizza = Pizza::create([
            'naam'    => $request->naam,
            'size_id' => $request->size_id, 
        ]);
    
        $pizza->ingredienten()->attach($request->ingredienten);
    
        return redirect()->route('menu.index')
                         ->with('success', 'Pizza aangemaakt!');
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

        return redirect()->route('menu.index')->with('success', 'Pizza deleted!');
    }
}
