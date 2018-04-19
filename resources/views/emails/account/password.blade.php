@component('mail::message')
# Passwort geändert

Ihr Passwort wurde erfolgreich geändert. Ignorieren Sie diese Nachricht falls Sie das waren.

Falls Sie Ihr Passwort nicht kürzlich nicht geändert haben, setzen Sie Ihr Passwort umgehend zurück!

@component('mail::button', ['url' => route('password.request')])
Passwort zurücksetzen
@endcomponent

Danke,<br>
{{ config('app.name') }}
@endcomponent
