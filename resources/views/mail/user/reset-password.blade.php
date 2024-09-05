<x-mail::layout>

<x-slot:header>
<x-mail::header url="{{config('app.url')}}">
  <div style="text-align: center;display: flex;justify-content: center;align-items: center; flex-direction: column; width: 100%!important;">
    <img src="https://laravel.com/img/logomark.min.svg" width="120px" class="logo" alt="Christchant Logo"
    style="display: inline-block;" >
  <br/>
    Reset Password
  </div>
</x-mail::header>
</x-slot:header>

<p>Hello {{$user->first_name}}, you have requested to reset your password. </p>
<p>To reset your password, please click on the following link:</p>
<br>
<p style="text-align: center; margin: 20px auto">
  <a href="{{ config('app.frontend_url') }}/account/auth/{{ $token }}/set-new-password">Set New Password</a>
</p>
<br>

<p>If you did not request a password reset, please ignore this email.</p>

<p>Best regards,</p>
<p>{{ config('app.name') }} Team</p>

<x-slot:footer>
<x-mail::footer>
<p>All rights reserved &copy; {{ config('app.name') }}</p>
</x-mail::footer>
</x-slot:foot>

</x-mail::layout>