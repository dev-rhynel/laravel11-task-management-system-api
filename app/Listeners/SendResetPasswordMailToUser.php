<?php

namespace App\Listeners;

use App\Mail\ResetPasswordMailToUser;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordMailToUser
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
        Mail::to($event->user->email)->send(new ResetPasswordMailToUser($event->user, $event->token));
    }
}
