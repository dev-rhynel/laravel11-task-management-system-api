<x-mail::layout>

<x-slot:header>
<x-mail::header url="{{config('app.url')}}">
  <div style="text-align: center;display: flex;justify-content: center;align-items: center; flex-direction: column; width: 100%!important;">
    <img src="https://laravel.com/img/logomark.min.svg" width="120px" class="logo" alt="Laravel Logo"
    style="display: inline-block;" >
  <br/>
  Hello {{$user->first_name}}!
  </div>
</x-mail::header>
</x-slot:header>

<p>Hello {{$user->first_name}} you have completed the task!</p>
<br>

<p>If you have any questions or need assistance, please don't hesitate to contact us at {{ config('mail.support_email') }}.</p>

<p>Best regards,</p>
<p>{{ config('app.name') }} Team</p>

<x-slot:footer>
<x-mail::footer>
<p>All rights reserved &copy; {{ config('app.name') }}</p>
</x-mail::footer>
</x-slot:foot>

</x-mail::layout>