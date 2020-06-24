<?php

namespace App\Mail;

use App\Models\Contacts;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NewContactMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var Contacts
     */
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contacts $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $parameters = $this->contact;
        $user = Auth::user();

        return $this->from('agenda.vexpenses@outlook.com', 'Agenda de Contatos')
            ->subject('Novo contato registrado!')
            ->view('emails.new-contact')
            ->with('contact', $parameters)
            ->with('user', $user);
    }
}
