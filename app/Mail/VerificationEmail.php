<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $vmessage;

    /**
     * Create a new vmessage instance.
     */
    public function __construct($vmessage)
    {
        $this->vmessage = $vmessage;
    }

    /**
     * Get the vmessage envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification Email',
        );
    }

    /**
     * Get the vmessage content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verification',
            with: [
                'name' => $this->vmessage,
                'vmessage' => $this->vmessage,
            ],
        );
    }

    /**
     * Get the attachments for the vmessage.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
