@extends('layouts.main')

@section('title', 'Deelnemen')

@section('content')
    @if (session()->has('store_participant_success'))
        <div class="alert alert-success">{{ session('store_participant_success') }}</div>
    @endif {{-- @else --}}
        {!! form($form) !!}
    {{-- @endif --}}
@endsection
