<x-mail::layout>

<x-slot:header>
<x-mail::header url="{{config('app.url')}}">
  <div style="text-align: center;display: flex;justify-content: center;align-items: center; flex-direction: column; width: 100%!important;">
    <img src="https://laravel.com/img/logomark.min.svg" width="120px" class="logo" alt="Laravel Logo"
    style="display: inline-block;" >
  <br/>
  Welcome {{$user->first_name}}!
  </div>
</x-mail::header>
</x-slot:header>

<p>Welcome {{$user->first_name}} to Laravel. We are excited to have you on board! You have successfully registered for an account on our platform.</p>
<p>To get started, please click on the following link to verify your email address:</p>
<br>
<p style="text-align: center; margin: 20px auto"><a href="{{ config('app.frontend_url') }}/account/auth/{{ $user->email_verification_token }}/verify">Verify Email Address</a></p>
<br>

<p>If you have any questions or need assistance, please don't hesitate to contact us at {{ config('mail.support_email') }}.</p>

<p>If this is not you, please ignore this email.</p>

<p>Best regards,</p>
<p>{{ config('app.name') }} Team</p>

<x-slot:footer>
<x-mail::footer>
<p>All rights reserved &copy; {{ config('app.name') }}</p>
</x-mail::footer>
</x-slot:foot>

</x-mail::layout>