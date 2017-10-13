@extends('layouts.app')

@section('title', 'Deelnemen')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">Deelnemen</div>
                    <div class="panel-body">
                        {!! form($form) !!}
                    </div>
            </div>
        </div>
    </div>
@endsection
