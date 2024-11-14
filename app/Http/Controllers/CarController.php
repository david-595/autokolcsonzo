<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::whereDoesntHave('rents', function ($query) {
            $query->whereNull('rent_end');
        })->get();
        return view('cars.index', compact('cars'));
    }

    public function show(Request $request)
    {
        $car = Car::findOrFail($request->id);
        return view('cars.show', ['car' => $car]);
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_model' => 'required|string|max:255',
            'caution_money' => 'required|integer|min:0',
            'km_price' => 'required|integer|min:0',
            'day_price' => 'required|integer|min:0',
            'description' => 'required|string|max:255'
        ]);

        Car::create($request->all());
        return redirect()->back()->with('success', 'Car stored.');
    }
}
