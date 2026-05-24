<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $qrImagePath;

    public function __construct($registration, $qrImagePath = null)
    {
        $this->registration = $registration;
        $this->qrImagePath = $qrImagePath ?: public_path('images/qr.jpg');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Tea Party Cruise Registration – Please Complete Payment',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-registration',
        );
    }
}