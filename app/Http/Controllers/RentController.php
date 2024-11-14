<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    // Ez a metódus a bérlések listáját adja vissza, szűrhető a bérlés befejezésének dátuma alapján.
    public function index(Request $request)
    {
        // Létrehoz egy lekérdezési objektumot a Rent modellhez.
        $query = Rent::query();

        // Ha a kérésben szerepel a 'search_rent_end' paraméter és az igaz, csak az aktív bérléseket szűri ki.
        if ($request->has('search_rent_end') && $request->search_rent_end)
        {
            // Csak azokat veszi figyelembe, ahol a bérlés befejezésének dátuma (rent_end) NULL.
            $query->whereNull('rent_end');   
        }
        
        // A lekérdezés eredményének lekérése.
        $rents = $query->get();

        // Visszaadja a 'rents.index' nézetet a bérlések listájával.
        return view('rents.index', compact('rents'));
    }

    // Ez a metódus egy új bérlés rögzítésére szolgál.
    public function store(Request $request)
    {
        // Validálja a bemeneti adatokat:
        $request->validate([
            'email' => 'required|string|max:255', // Az ügyfél email címe, kötelező, max 255 karakter.
            'rent_start' => 'required|date', // A bérlés kezdési dátuma, kötelező, dátum típus.
            'car_id' => 'required|integer|min:0|exists:cars,id' // Az autó azonosítója, kötelező, léteznie kell a cars táblában.
        ]);

        // Létrehozza a bérlés rekordot a bemeneti adatok alapján.
        Rent::create([
            'email' => $request->email,
            'car_id' => $request->car_id,
            'rent_start' => $request->rent_start
        ]);

        // Visszairányítja a felhasználót a 'cars.index.index' oldalra sikeres üzenettel.
        return redirect()->route('cars.index.index')->with('success', 'Rent stored');
    }

    // Ez a metódus egy konkrét bérlés adatait jeleníti meg.
    public function show($id)
    {
        // Lekérdezi a bérlést ID alapján, ha nem találja, hibát dob.
        $rent = Rent::findOrFail($id);
        
        // Visszaadja a 'rents.show' nézetet a kiválasztott bérlés adataival.
        return view('rents.show', ['rent' => $rent]);
    }

    // Ez a metódus egy meglévő bérlés adatainak frissítésére szolgál.
    public function update(Request $request, $id)
    {
        // Validálja a bemeneti adatokat:
        $request->validate([
            'rent_end' => 'required|date', // A bérlés befejezésének dátuma, kötelező, dátum típus.
            'km' => 'required|integer|min:0', // Megtett kilométer, kötelező, pozitív egész szám.
        ]);

        // Lekérdezi a bérlést ID alapján, ha nem találja, hibát dob.
        $rent = Rent::findOrFail($id);

        // Beállítja a bérlés befejezési dátumát és a megtett kilométert.
        $rent->rent_end = $request->rent_end;
        $rent->km = $request->km;

        // Kiszámítja az összesített árat: megtett km * km díj + napi díj.
        $rent->all_price = $request->km * $rent->car->km_price + $rent->car->day_price;

        // Elmenti a frissített adatokat az adatbázisban.
        $rent->save();

        // Visszairányítja a felhasználót a 'rents.index' oldalra sikeres üzenettel.
        return redirect()->route('rents.index')->with('success', 'Rent updated.');
    }
}
