@extends('layouts.main')

@section('title', 'Stem')

@section('content')
    <p class="lead">Stem op jouw favoriete foto!</p>
    @forelse ($participants as $participant)
        <div class="thumbnail pull-left">
            <img src="{{ asset($participant->image_path) }}" alt="{{ $participant->name }}">
            <div class="caption">
                <small>{{ $participant->name }}</small>
                <p class="d-inline-block">{{ $participant->votes }} @if($participant->votes == 1) stem @else stemmen @endif</p>
            </div>
        </div>
    @empty
        <p class="lead">Geen deelnemers :(</p>
    @endforelse
@endsection
