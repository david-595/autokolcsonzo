<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New car</title>
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
        
    <h2>New car</h2>
    <form action="{{route('cars.create.store')}}" method="post">
    @csrf
        <label for="car_model">Model:</label>
        <input type="text" id="car_model" name="car_model"> <br>
        <label for="caution_money">Caution:</label>
        <input type="text" id="caution_money" name="caution_money"> <br>
        <label for="km_price">Km price:</label> 
        <input type="text" id="km_price" name="km_price"> <br>
        <label for="day_price">Day price:</label>
        <input type="text" id="day_price" name="day_price"> <br>
        <label for="description">Descripton:</label>
        <input type="text" id="description" name="description"> <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>