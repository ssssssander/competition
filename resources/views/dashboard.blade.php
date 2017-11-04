@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="pull-left">
        <p>Deelnemers in totaal: {{ $totalParticipantCount }}</p>
        <p>Deelnemers deze periode: {{ $thisTermParticipantCount }}</p>
        <p>{{ $currentTermNr == 0 ? 'De wedstrijd is voorbij!' : "Huidige periode: {$currentTermNr} van de {$termCount}" }}</p>
    </div>
    <div class="pull-right">
        <a href="{{ route('terms') }}" class="btn btn-lg btn-default text-uppercase">Wijzig periodes</a>
        {!! Form::open(['route' => 'export_participants', 'class' => 'reset-form']) !!}
        {!! Form::submit('Exporteer naar Excel', ['class' => 'btn btn-lg btn-default text-uppercase']) !!}
        {!! Form::close() !!}
        {!! Form::open(['route' => 'reset', 'method' => 'delete', 'class' => 'reset-form']) !!}
        {!! Form::button('Reset wedstrijd', ['class' => 'btn btn-lg btn-danger text-uppercase reset']) !!}
        {!! Form::close() !!}
    </div>
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
                    <td>
                        <a href="{{ url('storage/' . $participant->image_path) }}" target="_blank" class="btn btn-default" data-toggle="tooltip" title="Open in een nieuw venster">Link</a>
                    </td>
                    <td>{{ $participant->created_at }}</td>
                    <td>
                        {!! Form::open(['route' => ['delete_participant', $participant], 'method' => 'delete', 'class' => 'delete-participant-form']) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-remove"></span>',
                            ['class' => 'btn btn-danger delete-participant', 'data-toggle' => 'tooltip', 'title' => 'Verwijder deze deelnemer']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">Geen deelnemers :(</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <script>
        $('.delete-participant').on('click', function(){
            bootbox.confirm({
                title: 'Deelnemer verwijderen',
                message: 'Weet je zeker dat je deze deelnemer wil verwijderen?',
                buttons: {
                    confirm: {
                        label: 'Ja',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: 'Nee, breng me terug!'
                    }
                },
                callback: function(result){ if(result) $('.delete-participant-form').submit(); }
            })
        });

        $('.reset').on('click', function(){
            bootbox.confirm({
                title: 'Wedstijd resetten',
                message: 'Weet je zeker dat je de wedstrijd wil resetten? Dit zal alle deelnemers, winnaars en periodes resetten en je een volledig schone lei geven.',
                buttons: {
                    confirm: {
                        label: 'Ja',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: 'Nee, breng me terug!'
                    }
                },
                callback: function(result){ if(result) $('.reset-form').submit(); }
            })
        });
    </script>
@endsection
