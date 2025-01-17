<?php

namespace App\Http\Controllers;

use App\Models\Voertuig;
use Illuminate\Http\Request;

class VoertuigController extends Controller
{

    public function index()
    {
        $voertuigen = Voertuig::all(); 
        return view('voertuigen.index', compact('voertuigen'));
    }
    


    public function create()
    {
        return view('voertuigen.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'naam'     => 'required|string|max:255',
            'merk'     => 'required|string|max:255',
            'soort'    => 'required|string|max:50', 
        ]);
    
        Voertuig::create([
            'naam'     => $request->input('naam'),
            'merk'     => $request->input('merk'),
            'soort'    => $request->input('soort'),
        ]);
    
        return redirect()->route('voertuigen.index')
                         ->with('success', 'Voertuig succesvol toegevoegd!');
    }


    public function edit(Voertuig $voertuig)
    {
        return view('voertuigen.edit', compact('voertuig'));
    }


    public function update(Request $request, Voertuig $voertuig)
    {
        $request->validate([
            'naam'     => 'required|string|max:255',
            'merk'     => 'required|string|max:255',
            'soort'    => 'required|string|max:50',
        ]);
    
        $voertuig->update([
            'naam'     => $request->input('naam'),
            'merk'     => $request->input('merk'),
            'soort'    => $request->input('soort'),
        ]);
    
        return redirect()->route('voertuigen.index')
                         ->with('success', 'Voertuig succesvol bijgewerkt!');
    }


    public function destroy(Voertuig $voertuig)
    {
        $voertuig->delete();

        return redirect()
            ->route('voertuigen.index')
            ->with('success', 'Voertuig succesvol verwijderd!');
    }
}
