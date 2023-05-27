<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class ContactUsEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public string $email = '', public $infor = null)
    {
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
                'email' => $this->email,
                'infor' => $this->infor,
            ],
        );
    }
}
