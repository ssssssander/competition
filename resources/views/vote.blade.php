@extends('layouts.main')

@section('title', 'Stem')

@section('content')
    <p class="lead">Stem op jouw favoriete foto!</p>
    @forelse ($participantsFromThisTerm as $participant)
        <div class="thumbnail pull-left">
            <a href="{{ url('storage/' . $participant->image_path) }}" target="_blank" data-toggle="tooltip" title="Open in een nieuw venster">
                <img src="{{ asset('storage/' . $participant->image_path) }}" alt="{{ $participant->name }}">
            </a>
            <div class="caption pull-left">
                <small>{{ $participant->name }}</small>
                <p>{{ $participant->votes }} @if($participant->votes == 1) stem @else stemmen @endif</p>
            </div>
            @if ($vote->where('ip', $ip)->where('participant_id', $participant->id)->count() >= 1)
                <span class="pull-right" data-toggle="tooltip" title="Je hebt op deze foto gestemd"></span>
            @elseif ($participant->ip == $ip)
                <span class="pull-right own" data-toggle="tooltip" title="Je kan niet op jezelf stemmen"></span>
            @else
                {!! Form::open(['route' => ['increment_vote', $participant], 'class' => 'pull-right', 'data-toggle' => 'tooltip', 'title' => 'Stem op deze foto']) !!}
                {!! Form::submit('') !!}
                {!! Form::close() !!}
            @endif
        </div>
    @empty
        <p class="lead">Geen deelnemers :(</p>
    @endforelse
@endsection
