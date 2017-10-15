@extends('layouts.app')

@section('title', 'Home')

@section('main')
    <div class="container">
        <div class="jumbotron">
            <a href="{{ route('participate') }}" class="btn btn-lg btn-default btn-block text-uppercase" role="button">Neem nu deel</a>
            <div class="row">
                <div class="col-md-8">
                    <h1>Iron Maiden wedstrijd</h1>
                    <h2>Maak elke week kans op een Iron Maiden 2017 Collectors Box</h2>
                    <p>Vier weken lang geven wij elke week een Iron Maiden 2017 Collectors Box weg aan de persoon die de meeste stemmen behaald met zijn of haar upgeloade foto van zichzelf.</p>
                    <p>Upload een Iron Maiden-waardige foto van jezelf en laat iedereen weten dat ze op jouw foto moeten stemmen!</p>
                    <p>Aan het einde van de periode waarin je hebt deelgenomen zal je je naam op deze pagina zien als je hebt gewonnen.</p>
                </div>
                <div class="col-md-4">
                    <img class="img-responsive center-block" src="{{ asset('images/collection-transparent.png') }}" alt="Iron Maiden 2017 Collectors Box">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                        @foreach ($terms as $term)
                            <li class="list-group-item">Week {{ $term->term }}:
                                <time datetime="{{ $term->start }}"></time>{{ $term->start }} tot
                                <time datetime="{{ $term->end }}"></time>{{ $term->end }}
                                <strong class="pull-right">Winnaar:
                                    @if ($winner->term == $term->term)
                                        {{ $winner['name'] }}
                                    @else
                                        ???
                                    @endif
                                </strong>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <a href="{{ route('participate') }}" class="btn btn-lg btn-default btn-block text-uppercase" role="button">Neem nu deel</a>
        </div>
    </div>
@endsection
