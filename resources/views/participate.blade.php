@extends('layouts.main')

@section('title', 'Deelnemen')

@section('content')
    @if (session()->has('store_participant_success'))
        <div class="alert alert-success alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          {{ session('store_participant_success') }}
        </div>
    @endif {{-- @else --}}
        {!! form($form) !!}
    {{-- @endif --}}
@endsection
