@extends('layouts.main')

@section('title', 'Stem')

@section('content')
    <p class="lead">Stem op jouw favoriete foto!</p>
    @forelse ($participants as $participant)
        <div class="thumbnail pull-left">
            <a href="{{ url('storage/' . $participant->image_path) }}" target="_blank" data-toggle="tooltip" title="Open in een nieuw venster">
                <img src="{{ asset('storage/' . $participant->image_path) }}" alt="{{ $participant->name }}">
            </a>
            <div class="caption pull-left">
                <small>{{ $participant->name }}</small>
                <p>{{ $participant->votes }} @if($participant->votes == 1) stem @else stemmen @endif</p>
            </div>
            <a href="{{ route('increment_vote', ['participant' => $participant]) }}" alt="Stem" class="pull-right" data-toggle="tooltip" title="Stem op deze foto" style="background-image: url('../images/vote.png')"></a>
        </div>
    @empty
        <p class="lead">Geen deelnemers :(</p>
    @endforelse
@endsection
