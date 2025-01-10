@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    @foreach ($pizzas as $pizza)
    <li>{{ $pizza->naam }}</li>
    @endforeach
</body>
</html>
@endsection