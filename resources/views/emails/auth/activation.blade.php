@component('mail::message')
# aktivieren Sie Ihren Account

Vielen Dank fürs Registrieren. Bitte aktivieren Sie nun Ihren Account.

@component('mail::button', ['url' => route('auth.activate', ['token' => $user->activation_token, 'email' => $user->email])])
    Aktivieren
@endcomponent

Danke,<br>
{{ config('app.name') }}
@endcomponent
