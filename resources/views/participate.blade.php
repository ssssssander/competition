@extends('layouts.app')

@section('title', 'Deelnemen')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">Deelnemen</div>
                    <div class="panel-body">
                        @if (session()->has('store_participant_success'))
                            <div class="alert alert-success">{{ session('store_participant_success') }}</div>
                        @else
                            {!! form($form) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
