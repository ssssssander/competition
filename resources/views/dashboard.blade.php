@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <p class="lead">Lijst deelnemers + soft delete</p>
    <p class="lead">symlink? php artisan storage:link :(</p>
    <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>E-mailadres</th>
                <th>Stemmen</th>
                <th>IP-adres</th>
                <th>Afbeelding</th>
                <th>Gemaakt op</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($participants as $participant )
                <tr>
                    <th>{{ $participant->name }}</th>
                    <th>{{ $participant->address }}</th>
                    <th>{{ $participant->city }}</th>
                    <th>{{ $participant->email }}</th>
                    <th>{{ $participant->votes }}</th>
                    <th>{{ $participant->ip }}</th>
                    <th><img src="{{ asset('') }}" alt="Foto hier"></th>
                    <th>{{ $participant->created_at }}</th>
                </tr>
            @empty
                <tr>
                    <th>Geen deelnemers :(</th>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
