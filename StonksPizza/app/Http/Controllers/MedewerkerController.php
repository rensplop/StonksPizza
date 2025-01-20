<?php

namespace App\Http\Controllers;

use App\Models\Medewerker;
use Illuminate\Http\Request;

class MedewerkerController extends Controller
{
    public function index()
    {
        $medewerkers = Medewerker::all();
        return view('medewerkers.index', compact('medewerkers'));
    }

    public function create()
    {
        return view('medewerkers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'email' => 'required|email|unique:medewerker,email',
        ]);

        Medewerker::create($request->all());

        return redirect()->route('medewerkers.index')->with('success', 'Medewerker toegevoegd.');
    }

    public function show(Medewerker $medewerker)
    {
        return view('medewerkers.show', compact('medewerker'));
    }

    public function edit(Medewerker $medewerker)
    {
        return view('medewerkers.edit', compact('medewerker'));
    }

    public function update(Request $request, Medewerker $medewerker)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'email' => 'required|email|unique:medewerker,email,' . $medewerker->id,
        ]);

        $medewerker->update($request->all());

        return redirect()->route('medewerkers.index')->with('success', 'Medewerker bijgewerkt.');
    }

    public function destroy(Medewerker $medewerker)
    {
        $medewerker->delete();

        return redirect()->route('medewerkers.index')->with('success', 'Medewerker verwijderd.');
    }
}
