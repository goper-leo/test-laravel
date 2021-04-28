@component('mail::message')
Hello,
<br><br>

You can sign-up by clicking the button below.
@component('mail::button', ['url' => route('auth.sign_up', ['code' => $invitation->code])])
Sign Up
@endcomponent

If button doesn't work, you can copy and paste link below@auth
{{ route('auth.sign_up', ['code' => $invitation->code]) }}

Cheers,<br>
The {{ config('app.name') }} team
@endcomponent