@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">

        <div class="jumbotron">
            <h1>Game Mania wedstrijd</h1>
            <p>Win win win!</p>
            <a href="{{ route('participate') }}">Neem hier deel</a>
        </div>
    </div>
@endsection
