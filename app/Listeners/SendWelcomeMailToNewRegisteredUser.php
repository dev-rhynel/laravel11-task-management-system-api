<?php

namespace App\Listeners;

use App\Mail\WelcomeNewUser;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailToNewRegisteredUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        Mail::to($event->user->email)->send(new WelcomeNewUser($event->user));
    }
}
