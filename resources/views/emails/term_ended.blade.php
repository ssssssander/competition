@component('mail::message')
# Dag {{ $adminName }}

Periode {{ $currentTermNr }} van de wedstrijd is voorbij, {{ is_null($winner) ? 'er is geen winnaar deze periode' : "de winnaar van deze periode is {$winner->name}" }}, {{ $currentTermNr == 0 ? 'de wedstrijd is voorbij!' : "periode {$nextTermNr} begint nu." }}

@component('mail::button', ['url' => '/'])
Ga naar de website
@endcomponent

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
