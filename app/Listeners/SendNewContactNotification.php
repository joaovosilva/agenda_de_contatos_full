<?php

namespace App\Listeners;

use App\Events\NewContact;
use App\Mail\NewContactMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendNewContactNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewContact  $event
     * @return void
     */
    public function handle(NewContact $event)
    {
        $contact = $event->contact;
        $email = $event->email;

        Mail::to($email)->queue(new NewContactMail($contact));
        // return (new NewContactMail($contact))->render();
    }
}
