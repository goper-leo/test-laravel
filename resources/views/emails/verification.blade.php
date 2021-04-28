@component('mail::message')
Hello,
<br><br>

Enter code below to verify your'e account.
<br>
@component('mail::panel')
{{ $user->code }}
@endcomponent

Cheers,<br>
The {{ config('app.name') }} team
@endcomponent