@extends('layouts.app')

@section('title', 'Stem')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-uppercase">Stem</div>
                    <div class="panel-body">
                        <p class="lead">Stem op jouw favoriete foto!</p>
                        <p class="lead">symlink? php artisan storage:link :(</p>
                        <div class="col-md-4 thumbnail">
                            <img src="{{ asset('') }}" alt="Foto hier">
                            <div class="caption">Een afbeelding</div>
                        </div>
                        <div class="col-md-4 thumbnail">
                            <img src="{{ asset('') }}" alt="Foto hier">
                            <div class="caption">Een afbeelding</div>
                        </div>
                        <div class="col-md-4 thumbnail">
                            <img src="{{ asset('') }}" alt="Foto hier">
                            <div class="caption">Een afbeelding</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
