<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TransactionNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user's name.
     */
    public $name;

    /**
     * The transaction amount.
     */
    public $amount;

    /**
     * The transaction category (e.g., Holding Balance, Mining Balance).
     */
    public $transactionCategory;

    /**
     * The transaction type (Credit or Debit).
     */
    public $transactionType;

    /**
     * The transaction date.
     */
    public $date;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $amount, $transactionCategory, $transactionType, $date)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->transactionCategory = $transactionCategory;
        $this->transactionType = $transactionType;
        $this->date = $date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transaction Notification'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transaction_notification', // Ensure this view exists
            with: [
                'name' => $this->name,
                'amount' => $this->amount,
                'transactionCategory' => $this->transactionCategory,
                'transactionType' => $this->transactionType,
                'date' => $this->date,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
