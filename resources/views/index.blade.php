@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <a href="{{ route('participate') }}" class="btn btn-lg btn-primary btn-block text-uppercase" role="button">Neem nu deel</a>
            <h1>Iron Maiden wedstrijd</h1>
            <h2>Maak elke week kans op een Iron Maiden 2017 Collectors Box</h2>
            <p>Vier weken lang geven wij elke week een Iron Maiden 2017 Collectors Box weg aan de persoon die de meeste stemmen behaald met zijn of haar upgeloade foto van zichzelf.</p>
            <p>Upload een Iron Maiden-waardige foto van jezelf en laat iedereen weten dat ze op jouw foto moeten stemmen!</p>
            <p>Aan het einde van de periode waarin je hebt deelgenomen zal je je naam op deze pagina zien als je hebt gewonnen.</p>
            <ul>
                <li>Periode 1: xx/xx/xx 00:00:00 tot xx/xx/xx 00:00:00</li>
                <li>Periode 2: xx/xx/xx 00:00:00 tot xx/xx/xx 00:00:00</li>
                <li>Periode 3: xx/xx/xx 00:00:00 tot xx/xx/xx 00:00:00</li>
                <li>Periode 4: xx/xx/xx 00:00:00 tot xx/xx/xx 00:00:00</li>
            </ul>
            <img class="img-responsive center-block" src="{{ asset('images/collection-transparent-small.png') }}" alt="Iron Maiden 2017 Collectors Box">
            <a href="{{ route('participate') }}" class="btn btn-lg btn-primary btn-block text-uppercase" role="button">Neem nu deel</a>
            <h2>Winnaars</h2>
            <p>De winnaars komen hier</p>
        </div>
    </div>
@endsection
