<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rents</title>
</head>
<style>
    td, th{
        padding: 15px;
        text-align: center;
    }
    td, th{
        border: 1px solid black;
        border-collapse: collapse;
    }
    table{
        border-collapse: collapse;
    }
    #gombok{
        border: none;
    }
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
    
    <h1 style="text-align: center">Rents</h1>
    
    <form style="text-align: center;" action="{{route('rents.index')}}">In progress:<input type="checkbox" name="search_rent_end" id="search_rent_end" {{ request('search_rent_end') ? 'checked' : '' }}><input type="submit" value="Search"></form>
    <table style="margin: auto">
        <tr>
            <th>Email</th>
            <th>Car model</th>
            <th>Rent start</th>
            <th>Rent end</th>
            <th>Km</th>
            <th>All price</th>
        </tr>
        @foreach ($rents as $rent)
            <tr>
                <td>{{$rent->email}}</td>
                <td>{{$rent->car->car_model}}</td>
                <td>{{$rent->rent_start}}</td>
                <td>{{$rent->rent_end}}</td>
                <td>{{$rent->km}}</td>
                <td>{{$rent->all_price}}</td>
                @if ($rent->rent_end == NULL)
                    <form action="{{route('rents.show', $rent->id)}}" method="get">
                    @csrf
                        <td id="gombok"><button type="submit">Visszavétel</button></td>   
                    </form>          
                @else
                <td id="gombok"></td>
                @endif
            </tr>
        @endforeach
    </table>
</body>
</html>