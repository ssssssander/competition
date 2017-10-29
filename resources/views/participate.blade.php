@extends('layouts.main')

@section('title', 'Deelnemen')

@section('content')
    @if ($hasParticipated)
        <div class="alert alert-success">Je deelname is bevestigd!</div>
    @else
        {!! form($form) !!}
    @endif
@endsection
