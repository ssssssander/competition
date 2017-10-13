@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Iron Maiden wedstrijd</h1>
            <p>Win win win!</p>
            <a href="{{ route('participate') }}" class="btn btn-lg btn-primary btn-block text-uppercase" role="button">Neem nu deel</a>
        </div>
    </div>
@endsection
