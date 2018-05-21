@component('mail::message')
# Aktivieren Sie Ihren Account

Vielen Dank fürs Registrieren. Bitte aktivieren Sie nun Ihren Account.

@component('mail::button', ['url' => route('auth.activate', ['token' => $user->activation_token, 'email' => $user->email])])
    Aktivieren
@endcomponent

Danke,<br>
das Nachhilfe-Plattform Team
@endcomponent
