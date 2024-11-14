<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
</head>
<style>
    td, th{
        padding: 15px;
        text-align: center;
    }
    td, th, table{
        border: 1px solid black;
        border-collapse: collapse;}
</style>
<body>
    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
    @endif

    @if (session('success'))
        {{session('success')}}
    @endif

    <table style="margin: auto">
        <tr>
            <th>Model</th>
            <th>Caution money</th>
            <th>Day price</th>
            <th>Km price</th>
        </tr>
        @foreach ($cars as $car )
            <tr>
                <form action="{{route('cars.index.show', $car->id)}}" method="get">
                @csrf
                <td>{{$car->car_model}}</td>
                <td>{{$car->caution_money}}</td>
                <td>{{$car->km_price}}</td>
                <td>{{$car->day_price}}</td>
                <td><button type="submit">Rent</button></td>
                </form>
            </tr>
        @endforeach
    </table>
</body>
</html>