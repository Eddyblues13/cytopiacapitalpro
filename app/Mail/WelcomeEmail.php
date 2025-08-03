<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $wMessage;

    /**
     * Create a new vwMessage instance.
     */
    public function __construct($wMessage)
    {
        $this->wMessage = $wMessage;
    }

    /**
     * Get the wMessage envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome',
        );
    }

    /**
     * Get the wMessage content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: [
                'name' => $this->wMessage,
                'wMessage' => $this->wMessage,
            ],
        );
    }

    /**
     * Get the attachments for the wMessage.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
