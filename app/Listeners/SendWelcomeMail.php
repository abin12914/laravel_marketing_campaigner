<?php

namespace App\Listeners;

use App\Events\ContactCreated;
use App\Notifications\WelcomeContact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeMail
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
    public function handle(ContactCreated $event): void
    {
        $event->contact->notify(
            new WelcomeContact($event->contact->username
        ));
    }
}
