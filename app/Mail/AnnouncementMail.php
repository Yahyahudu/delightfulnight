<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageBody;
    public $attendee;

    public function __construct($subject, $messageBody, $attendee)
    {
        $this->subject = $subject;
        $this->messageBody = $messageBody;
        $this->attendee = $attendee;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.announcement',
        );
    }
}