<?php

namespace App\Providers;

use App\Events\CompletedTask;
use App\Events\ResetPassword;
use App\Listeners\SendCompletedTaskMailToUser;
use App\Listeners\SendResetPasswordMailToUser;
use App\Listeners\SendWelcomeMailToNewRegisteredUser;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            Registered::class,
            SendWelcomeMailToNewRegisteredUser::class,
        );
        Event::listen(
            ResetPassword::class,
            SendResetPasswordMailToUser::class
        );
        Event::listen(
            CompletedTask::class,
            SendCompletedTaskMailToUser::class
        );
    }
}
