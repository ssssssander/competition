@extends('layouts.main')

@section('title', 'Stem')

@section('content')
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
@endsection
