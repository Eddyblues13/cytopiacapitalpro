<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $adminMessage;

    /**
     * Create a new message instance.
     *
     * @param string $adminMessage
     * @return void
     */
    public function __construct($adminMessage)
    {
        $this->adminMessage = $adminMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New User Registration Notification')
            ->html($this->adminMessage);
    }
}
