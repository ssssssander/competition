@component('mail::message')
# Dag wedstrijdverantwoordelijke

{{ "Periode {$currentTermNr} van de wedstrijd is voorbij, de winnaar van deze periode is {$winnerName}, periode {$nextTermNr} begint nu." }}

@component('mail::button', ['url' => '/'])
Ga naar de website
@endcomponent

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
