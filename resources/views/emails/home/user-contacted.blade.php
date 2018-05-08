@component('mail::message')
# Neue Nachricht von {{ $user->name }}

Betreff: {{ $title }}

Inhalt: {{ $content }}

Danke,<br>
{{ config('app.name') }}
@endcomponent
