<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DriverCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $driverName,
        public string $driverEmail,
        public string $temporaryPassword,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to GoRide - Your Driver Account Credentials',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.driver-credentials',
            with: [
                'driverName' => $this->driverName,
                'driverEmail' => $this->driverEmail,
                'temporaryPassword' => $this->temporaryPassword,
                'loginUrl' => config('app.url') . '/login',
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}