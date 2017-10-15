@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    @if (session()->has('delete_participant_success'))
        <div class="alert alert-success alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          {!! session('delete_participant_success') !!}
        </div>
    @endif
    <p>{{ $participantsCount }} @if($participantsCount > 1) deelnemers @else deelnemer @endif</p>
    <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                <th>Naam</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>E-mailadres</th>
                <th>Stemmen</th>
                <th>IP-adres</th>
                <th>Periode</th>
                <th>Afbeelding</th>
                <th>Gemaakt op</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($participants as $participant )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $participant->id }}</td>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->address }}</td>
                    <td>{{ $participant->city }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->votes }}</td>
                    <td>{{ $participant->ip }}</td>
                    <td>{{ $participant->term }}</td>
                    <td><a href="{{ url($participant->image_path) }}" target="_blank" class="btn btn-default" data-toggle="tooltip" title="Open in een nieuw venster">Link</a></td>
                    <td>{{ $participant->created_at }}</td>
                    <td><a href="{{ route('delete_participant', ['participant' => $participant]) }}" class="btn btn-danger" data-toggle="tooltip" title="Verwijder deze deelnemer">X</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">Geen deelnemers :(</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('terms') }}" class="btn btn-lg btn-default text-uppercase">Wijzig periodes</a>
@endsection
