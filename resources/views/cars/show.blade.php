<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Karakterkódolás beállítása UTF-8-ra. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Nézetablak mobil eszközökhöz. -->
    <title>Rent</title> <!-- Az oldal címe. -->
</head>
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

    <div>
        <h2>Car data</h2>
        
        <!-- Autó adatok megjelenítése -->
        <p>Car model: <b>{{$car->car_model}}</b></p>
        <p>Caution money: <b>{{$car->caution_money}}</b></p>
        <p>Km price: <b>{{$car->km_price}}</b></p>
        <p>Day price: <b>{{$car->day_price}}</b></p>
        <p>Description: <b>{{$car->description}}</b></p>

        <!-- Bérlés űrlap -->
        <form action="{{route('cars.index.store')}}" method="post">
            @csrf <!-- CSRF token az űrlap védelmére. -->
            
            <!-- Autó ID, email és bérlés kezdő dátumának megadása -->
            <input type="hidden" name="car_id" id="car_id" value="{{$car->id}}">
            Email address: <input type="email" name="email" id="email" placeholder="example@gmail.com"> <br>
            Rent start: <input type="date" name="rent_start" id="rent_start"> <br>
            
            <!-- Bérlés gomb -->
            <button type="submit">Rent</button>
        </form>
    </div>
</body>
</html>
