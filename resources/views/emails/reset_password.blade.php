@component('mail::message')
# Introduction
Click the button below to reset your password

@component('mail::button', ['url' => route('user.reset.password', ['user_id'=>base64_encode($user_id)])])
    Reset Password
@endcomponent

<p>Or manually enter the link below</p>
<p>
    <a>
        {{ route('user.reset.password', ['user_id'=>base64_encode($user_id)]) }}
    </a>
</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
