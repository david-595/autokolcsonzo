<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Karakterkódolás beállítása UTF-8-ra. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mobil kompatibilitás érdekében nézetablak beállítása. -->
    <title>Rents</title> <!-- Az oldal címe: 'Rents'. -->
</head>
<style>
    td, th {
        padding: 15px; /* Térköz hozzáadása a cellákhoz és fejlécekhez. */
        text-align: center; /* Középre igazítás. */
    }
    td, th {
        border: 1px solid black; /* Fekete keret hozzáadása a cellákhoz és fejlécekhez. */
        border-collapse: collapse; /* Cellák közötti rések összevonása. */
    }
    table {
        border-collapse: collapse; /* A táblázat összekapcsolása, hogy ne legyenek rések. */
    }
    #gombok {
        border: none; /* Az egyedi 'gombok' elemhez nincs keret. */
    }
</style>
<body>
    <!-- Hibaüzenetek megjelenítése, ha vannak (pl. hibás validálás esetén) -->
    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}<br> <!-- Hibaüzenetek soronként megjelenítése. -->
        @endforeach
    @endif

    <!-- Sikeres műveletről üzenet megjelenítése, ha van -->
    @if (session('success'))
        {{session('success')}}
    @endif
    
    <h1 style="text-align: center">Rents</h1> <!-- Fejléc középre igazítva -->

    <!-- Szűrő űrlap a bérlések keresésére, 'In progress' opcióval -->
    <form style="text-align: center;" action="{{route('rents.index')}}">
        In progress:
        <input type="checkbox" name="search_rent_end" id="search_rent_end" {{ request('search_rent_end') ? 'checked' : '' }}> <!-- Ha a 'search_rent_end' paraméter jelen van, pipa kerül a jelölőnégyzetbe. -->
        <input type="submit" value="Search"> <!-- Keresés gomb. -->
    </form>

    <!-- Bérléseket megjelenítő táblázat középre igazítva -->
    <table style="margin: auto">
        <tr>
            <th>Email</th>
            <th>Car model</th>
            <th>Rent start</th>
            <th>Rent end</th>
            <th>Km</th>
            <th>All price</th>
        </tr>
        
        <!-- Bérlések listázása -->
        @foreach ($rents as $rent)
            <tr>
                <td>{{$rent->email}}</td> <!-- Az ügyfél emailje -->
                <td>{{$rent->car->car_model}}</td> <!-- A bérelt autó modellje -->
                <td>{{$rent->rent_start}}</td> <!-- Bérlés kezdete -->
                <td>{{$rent->rent_end}}</td> <!-- Bérlés vége (NULL lehet) -->
                <td>{{$rent->km}}</td> <!-- Megtett kilométerek -->
                <td>{{$rent->all_price}}</td> <!-- Teljes ár -->

                <!-- Ha a bérlés nincs befejezve (rent_end NULL), 'Visszavétel' gomb megjelenítése -->
                @if ($rent->rent_end == NULL)
                    <form action="{{route('rents.show', $rent->id)}}" method="get">
                    @csrf
                        <td id="gombok"><button type="submit">Visszavétel</button></td> <!-- Gomb a visszavételhez -->
                    </form>          
                @else
                <td id="gombok"></td> <!-- Üres cella, ha a bérlés befejezett. -->
                @endif
            </tr>
        @endforeach
    </table>
</body>
</html>
