<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public $email;

    public $infor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $infor)
    {
        $this->name = $name;
        $this->email = $email;
        $this->infor = $infor;
    }



    public function envelope()
    {
        return new Envelope(
            // from: new Address('jeffrey@example.com', 'Jeffrey Way'),
            // replyTo: [
            //     new Address('taylor@example.com', 'Taylor Otwell'),
            // ],
            subject: 'Contact Us Email',
        );
    }

    public function attachments()
    {
        return [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.contactUs',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'infor' => $this->infor
            ],
        );
    }
}
