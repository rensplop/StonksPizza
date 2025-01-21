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
        $bestelling = Bestelling::where('user_id', Auth::id())
            ->where('status','open')
            ->with('bestelregels.pizza')
            ->first();
        return view('Orders.index', compact('pizzas','bestelling'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
        ]);
        $bestelling = Bestelling::firstOrCreate([
            'user_id' => Auth::id(),
            'status' => 'open'
        ], [
            'datum' => now(),
            'klant_id' => 1 
        ]);
        $regel = Bestelregel::where('bestelling_id',$bestelling->id)
            ->where('pizza_id',$request->pizza_id)
            ->first();
        if($regel) {
            $regel->aantal += 1;
            $regel->save();
        } else {
            Bestelregel::create([
                'bestelling_id' => $bestelling->id,
                'pizza_id' => $request->pizza_id,
                'aantal' => 1,
                'afmeting' => 'Groot'
            ]);
        }
        return redirect()
            ->route('bestellingen.index')
            ->with('success','Pizza toegevoegd aan bestelling');
    }
}
