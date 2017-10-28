@component('mail::message')
# Dag {{ $adminName }}

In de bijlage vind je een Excelbestand waarin de deelnemers van {{ $dateNow }} staan.

@component('mail::button', ['url' => '/'])
Ga naar de website
@endcomponent

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
