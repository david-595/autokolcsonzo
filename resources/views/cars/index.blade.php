<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Karakterkódolás beállítása UTF-8-ra. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Nézetablak mobil eszközökhöz. -->
    <title>Cars</title> <!-- Az oldal címe. -->
</head>
<style>
    /* Stílusok táblázathoz és cellákhoz */
    td, th {
        padding: 15px;
        text-align: center; /* Szöveg középre igazítása. */
    }
    td, th, table {
        border: 1px solid black; /* Fekete keret minden cellához és táblázathoz. */
        border-collapse: collapse; /* Összeolvasztja a szomszédos kereteket egy vonallá. */
    }
</style>
<body>
    <!-- Hibák megjelenítése, ha vannak, pl. hibás adatbevitel esetén -->
    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}<br> <!-- Hibák külön sorban megjelenítve. -->
        @endforeach
    @endif

    <!-- Sikeres művelet üzenetének megjelenítése -->
    @if (session('success'))
        {{session('success')}}
    @endif

    <!-- Autók listázása táblázatban -->
    <table style="margin: auto"> <!-- Táblázat középre igazítva. -->
        <tr>
            <th>Model</th>
            <th>Caution money</th>
            <th>Day price</th>
            <th>Km price</th>
        </tr>
        
        @foreach ($cars as $car)
            <tr>
                <form action="{{route('cars.index.show', $car->id)}}" method="get">
                @csrf <!-- CSRF token az űrlap védelmére. -->
                
                <!-- Autó adatok megjelenítése -->
                <td>{{$car->car_model}}</td>
                <td>{{$car->caution_money}}</td>
                <td>{{$car->day_price}}</td>
                <td>{{$car->km_price}}</td>
                
                <!-- Kiválasztás gomb az autó bérléséhez -->
                <td><button type="submit">Rent</button></td>
                </form>
            </tr>
        @endforeach
    </table>
</body>
</html>
