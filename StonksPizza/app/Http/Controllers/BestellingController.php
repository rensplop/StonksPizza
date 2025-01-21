<?php

namespace App\Http\Controllers;

use App\Models\Bestelling;
use App\Models\Bestelregel;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BestellingController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::all();
        $bestelling = Bestelling::where('status', 'open')
            ->with('bestelregels.pizza')
            ->first();

        return view('Orders.index', compact('pizzas', 'bestelling'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
        ]);

        $bestelling = Bestelling::firstOrCreate(
            ['status' => 'open'],
            ['datum' => now()]
        );

        $regel = Bestelregel::where('bestelling_id', $bestelling->id)
            ->where('pizza_id', $request->pizza_id)
            ->first();

        if ($regel) {
            $regel->aantal += 1;
            $regel->save();
        } else {
            Bestelregel::create([
                'bestelling_id' => $bestelling->id,
                'pizza_id'      => $request->pizza_id,
                'aantal'        => 1,
                'afmeting'      => 'groot'
            ]);
        }

        return redirect()
            ->route('bestellingen.index')
            ->with('success', 'Pizza toegevoegd aan bestelling');
    }

    public function destroyRegel(Bestelregel $regel)
    {
        $regel->delete();
        return redirect()
            ->route('bestellingen.index')
            ->with('success', 'Pizza verwijderd uit bestelling');
    }

    public function statusIndex()
    {
        if(Auth::check() && Auth::user()->hasRole('medewerker')) {
            $alleBestellingen = Bestelling::with('bestelregels.pizza')->get();
            return view('Status.index', ['alleBestellingen' => $alleBestellingen]);
        } else {
            $bestelling = Bestelling::where('status','open')
                ->orWhere('status','in voorbereiding')
                ->orWhere('status','geannuleerd')
                ->with('bestelregels.pizza')
                ->first();
            return view('Status.index', ['bestelling' => $bestelling]);
        }
    }

    public function annuleer($id)
    {
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = 'geannuleerd';
        $bestelling->save();
        return redirect()
            ->route('status.index')
            ->with('success', 'Bestelling is geannuleerd');
    }

    public function updateStatus(Request $request, $id)
    {
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = $request->status;
        $bestelling->save();
        return redirect()
            ->route('status.index')
            ->with('success', 'Status bijgewerkt');
    }
}
