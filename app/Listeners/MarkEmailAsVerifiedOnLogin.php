<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkEmailAsVerifiedOnLogin
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
    public function handle(Login $event): void
    {
        // If user logs in with the credentials we sent them, we consider them "Activated"
        if ($event->user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            $event->user->markEmailAsVerified();
        } elseif (is_null($event->user->email_verified_at)) {
             // For users who don't implement MustVerifyEmail interface but have the column
             $event->user->email_verified_at = now();
             $event->user->save();
        }
    }
}
