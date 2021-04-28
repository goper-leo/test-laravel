@component('mail::message')
Hello,
<br><br>

Enter code below to verify your'e account.
<br>
@component('mail::panel')
{{ $user->pin }}
@endcomponent

Cheers,<br>
The {{ config('app.name') }} team
@endcomponent