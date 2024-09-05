<?php

namespace App\Listeners;

use App\Mail\CompletedTaskMailToUser;
use Illuminate\Support\Facades\Mail;

class SendCompletedTaskMailToUser
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
        Mail::to($event->user->email)->send(new CompletedTaskMailToUser($event->user));
    }
}
