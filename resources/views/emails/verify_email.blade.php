@component('mail::message')
# Introduction
Welcome to {{ config('app.name') }}. Please click the button below to verify your email.


@component('mail::button', ['url' => route('user.verify.email', [$user_id])])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
