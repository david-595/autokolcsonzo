<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Ez a metódus a nem foglalt autók listáját adja vissza.
    public function index()
    {
        // Lekérdezi azokat az autókat, amelyek nincsenek aktívan bérbe adva.
        $cars = Car::whereDoesntHave('rents', function ($query) {
            // Csak azokat veszi figyelembe, ahol a bérlés befejezési dátuma (rent_end) NULL.
            $query->whereNull('rent_end');
        })->get();
        
        // Visszaadja a 'cars.index' nézetet az autók listájával.
        return view('cars.index', compact('cars'));
    }

    // Ez a metódus egy konkrét autó adatait jeleníti meg.
    public function show(Request $request)
    {
        // Lekérdezi az autót az ID alapján, ha nem találja, hibát dob.
        $car = Car::findOrFail($request->id);
        
        // Visszaadja a 'cars.show' nézetet a kiválasztott autó adataival.
        return view('cars.show', ['car' => $car]);
    }

    // Ez a metódus a 'cars.create' nézetet jeleníti meg, ahol új autó adható hozzá.
    public function create()
    {
        return view('cars.create');
    }

    // Ez a metódus elmenti az új autó adatait az adatbázisba.
    public function store(Request $request)
    {
        // Validálja a bemeneti adatokat:
        $request->validate([
            'car_model' => 'required|string|max:255', // Az autó modellje, kötelező, max 255 karakter.
            'caution_money' => 'required|integer|min:0', // Letét összege, kötelező, pozitív egész szám.
            'km_price' => 'required|integer|min:0', // Km díj, kötelező, pozitív egész szám.
            'day_price' => 'required|integer|min:0', // Napi díj, kötelező, pozitív egész szám.
            'description' => 'required|string|max:255' // Leírás, kötelező, max 255 karakter.
        ]);

        // Létrehoz egy új autó rekordot a bemeneti adatok alapján.
        Car::create($request->all());
        
        // Visszairányítja a felhasználót az előző oldalra sikeres üzenettel.
        return redirect()->back()->with('success', 'Car stored.');
    }
}
