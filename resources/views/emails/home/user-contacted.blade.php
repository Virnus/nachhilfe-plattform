@component('mail::message')
# Neue Nachricht von {{ $user->name }}

Betreff: {{ $title }}

Inhalt: {{ $content }}

Danke,<br>
Das Nachhilfe-Plattform Team
@endcomponent
