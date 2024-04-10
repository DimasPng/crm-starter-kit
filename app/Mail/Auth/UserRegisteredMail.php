<?php

namespace App\Mail\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class UserRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
      private User $user
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Registered',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.auth.registered',
            with: [
              'user' => $this->user,
              'url' => route('auth-confirm', [$this->user->confirm_token])
            ]
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
