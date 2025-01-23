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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
        ]);

        if(!Auth::check()) {
            return redirect()->route('login')->with('error','Je moet ingelogd zijn om te bestellen.');
        }

        $bestelling = Bestelling::where('user_id', Auth::id())
            ->where('status','open')
            ->first();

        if(!$bestelling) {
            $bestelling = Bestelling::create([
                'user_id' => Auth::id(),
                'status'  => 'open',
                'datum'   => now()
            ]);
        }

        $regel = Bestelregel::where('bestelling_id', $bestelling->id)
            ->where('pizza_id', $request->pizza_id)
            ->first();

        if($regel) {
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

    public function statusIndex()
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        if(Auth::user()->hasRole('medewerker') || Auth::user()->hasRole('admin')) {
            $alleBestellingen = Bestelling::with('bestelregels.pizza','user')->get();
            return view('Status.index', [
                'alleBestellingen' => $alleBestellingen
            ]);
        } else {
            $bestelling = Bestelling::where('user_id', Auth::id())
                ->orderBy('id','desc')
                ->with('bestelregels.pizza')
                ->first();
            return view('Status.index', [
                'bestelling' => $bestelling
            ]);
        }
    }

    public function annuleer($id)
    {
        $bestelling = Bestelling::where('id',$id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $bestelling->status = 'geannuleerd';
        $bestelling->save();

        return redirect()
            ->route('status.index')
            ->with('success','Bestelling is geannuleerd');
    }

    public function updateStatus(Request $request, $id)
    {
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = $request->status;
        $bestelling->save();

        return redirect()
            ->route('status.index')
            ->with('success','Status bijgewerkt');
    }
}
