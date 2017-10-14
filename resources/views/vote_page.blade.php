@extends('layouts.main')

@section('title', 'Stem')

@section('content')
    <p class="lead">Stem op jouw favoriete foto!</p>
    @forelse ($participants as $participant)
        <div class="col-md-4 thumbnail">
            <img src="{{ asset($participant->image_path) }}" alt="{{ $participant->name }}">
            <div class="caption text-center">
                <small>{{ $participant->name }}</small>
                <p>{{ $participant->votes }} @if($participant->votes == 1) stem @else stemmen @endif</p>
            </div>
        </div>
    @empty
        <p class="lead">Geen deelnemers :(</p>
    @endforelse
@endsection
