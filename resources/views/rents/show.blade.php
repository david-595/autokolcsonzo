<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- A karakterkódolás beállítása UTF-8-ra. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- A nézetablak beállítása mobil kompatibilitás érdekében. -->
    <title>Rents</title> <!-- Az oldal címe: 'Rents'. -->
</head>
<body>
    <!-- Hibák megjelenítése, ha vannak, pl. hibás adatbevitel esetén -->
    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}<br> <!-- Minden hibaüzenet külön sorban jelenik meg. -->
        @endforeach
    @endif

    <!-- Sikeres műveletről üzenet megjelenítése, ha van -->
    @if (session('success'))
        {{session('success')}}
    @endif

    <div>
        <h2>Rent data</h2> <!-- Fejléc 'Rent data' felirattal. -->
        
        <!-- Bérlés adatainak megjelenítése -->
        <p>Car model: <b>{{$rent->car->car_model}}</b></p> <!-- Az autó modellje. -->
        <p>Email: <b>{{$rent->email}}</b></p> <!-- Az ügyfél e-mail címe. -->
        <p>Rent start: <b>{{$rent->rent_start}}</b></p> <!-- A bérlés kezdő dátuma. -->

        <!-- Űrlap a bérlés lezárására és kilométer megadására -->
        <form action="{{route('rents.update', $rent->id)}}" method="post"> <!-- Űrlap, ami a 'rents.update' útvonalra küldi az adatokat a kiválasztott bérlés ID-jével. -->
            @csrf <!-- CSRF token, hogy védje az űrlapot az illetéktelen hozzáféréstől. -->
            @method('PUT') <!-- HTTP PUT metódus használata a bérlés adatainak frissítéséhez. -->

            <label for="rent_end">Rent end: </label>
            <input type="date" name="rent_end" id="rent_end"> <br> <!-- Bérlés befejezésének dátuma mező. -->
            
            <label for="km">Km: </label>
            <input type="number" min="0" name="km" id="km"> <br> <!-- Megtett kilométerek mezője, csak pozitív értékeket enged. -->

            <button type="submit">Submit</button> <!-- Küldés gomb az űrlap beküldéséhez. -->
        </form>
    </div>
</body>
</html>
