<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rents</title>
</head>
<body>
    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
    @endif

    @if (session('success'))
        {{session('success')}}
    @endif

    <div>
        <h2>Rent data</h2>
        <p>Car model: <b>{{$rent->car->car_model}}</b></p>
        <p>Email: <b>{{$rent->email}}</b></p>
        <p>Rent start: <b>{{$rent->rent_start}}</b></p>

        <form action="{{route('rents.update', $rent->id)}}" method="post">
            @csrf
            @method('PUT')

            <label for="rent_end">Rent end: </label>
            <input type="date" name="rent_end" id="rent_end"> <br>
            <label for="km">Km: </label>
            <input type="number" min="0" name="km" id="km"> <br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>