@component('mail::message')
# Dag {{ $adminName }}

Periode {{ $currentTermNr }} van de {{ $termCount }} van de wedstrijd is voorbij.<br>
De winnaar van deze periode is: {{ $winnerName }}.<br>
{{ $nextTermNr == 0 ? 'De wedstrijd is voorbij!' : "Periode {$nextTermNr} begint nu." }}

@component('mail::button', ['url' => 'https://competition.sander.borret.mtantwerp.eu'])
Ga naar de website
@endcomponent

Groetjes,<br>
{{ config('app.name') }}
@endcomponent
