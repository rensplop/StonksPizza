<?php

namespace App\Http\Controllers;

use App\Models\Bestelling;
use App\Models\Bestelregel;
use App\Models\Pizza;
use Illuminate\Http\Request;

class BestellingController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::all();


        $bestelling = Bestelling::where('status','open')
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
            ['datum'  => now()]
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
            ->with('success','Pizza toegevoegd aan bestelling');
    }

    public function destroyRegel(Bestelregel $regel)
{
    $regel->delete();
    return redirect()
        ->route('bestellingen.index')
        ->with('success','Pizza verwijderd uit bestelling');
}

}
