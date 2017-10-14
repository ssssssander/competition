@extends('layouts.app')

@section('title', 'Stem')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">Stem</div>
                    <div class="panel-body">
                        <p class="lead">Stem op jouw favoriete foto!</p>
                        <p class="lead">symlink? php artisan storage:link :(</p>
                        @forelse ($participants as $participant)
                            <div class="col-md-4 thumbnail">
                                <img src="{{ asset('') }}" alt="{{ $participant->name }}">
                                <div class="caption">{{ $participant->name }}</div>
                            </div>
                        @empty
                            <p class="lead">Geen deelnemers :(</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
