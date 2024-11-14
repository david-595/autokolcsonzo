<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index(Request $request)
    {
        $query = Rent::query();

        if ($request->has('search_rent_end') && $request->search_rent_end)
        {
            $query->whereNull('rent_end');   
        }
        
        $rents = $query->get();

        return view('rents.index', compact('rents'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'rent_start' => 'required|date',
            'car_id' => 'required|integer|min:0|exists:cars,id'
        ]);

        Rent::create([
            'email' => $request->email,
            'car_id' => $request->car_id,
            'rent_start' => $request->rent_start
        ]);

        return redirect()->route('cars.index.index')->with('success', 'Rent stored');
    }
    
    public function show($id)
    {
        $rent = Rent::findOrFail($id);
        return view('rents.show', ['rent' => $rent]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rent_end' => 'required|date',
            'km' => 'required|integer|min: 0',
        ]);

        $rent = Rent::findOrFail($id);
        $rent->rent_end = $request->rent_end;
        $rent->km = $request->km;
        $rent->all_price = $request->km*$rent->car->km_price + $rent->car->day_price;
        $rent->save();

        return redirect()->route('rents.index')->with('success', 'Rent updated.');
    }
}
