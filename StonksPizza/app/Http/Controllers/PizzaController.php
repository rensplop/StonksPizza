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
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $data = [
            'naam'    => $request->naam,
            'size_id' => $request->size_id,
        ];
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pizzas', 'public');
        }
    
        $pizza = Pizza::create($data);
        $pizza->ingredienten()->attach($request->ingredienten);
    
        return redirect()
            ->route('menu.index')
            ->with('success', 'Pizza aangemaakt!');
    }
    
    
    
    
    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        $sizes = Size::all(); 
        
        return view('Menu.edit', compact('pizza', 'ingredients', 'sizes'));
    }
    
    
    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'naam'         => 'required|string|max:255',
            'size_id'      => 'required|exists:sizes,id',
            'ingredienten' => 'required|array',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $pizza->update([
            'naam'    => $request->naam,
            'size_id' => $request->size_id,
        ]);
    
        $pizza->ingredienten()->sync($request->ingredienten);
    
        if ($request->hasFile('image')) {

    
            $imagePath = $request->file('image')->store('pizzas', 'public');
            $pizza->image = $imagePath;
            $pizza->save();
        }
    
        return redirect()->route('menu.index')->with('success', 'Pizza updated!');
    }
    
    
    

    public function destroy(Pizza $pizza)
    {
        $pizza->ingredienten()->detach();
        $pizza->delete();

        return redirect()->route('menu.index')->with('success', 'Pizza deleted!');
    }
}