<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageAnswer extends Mailable
{
    use Queueable, SerializesModels;

    public string $topic;
    public string $userMessage;
    public string $answer;

    /**
     * Create a new message instance.
     */
    public function __construct(string $topic, string $userMessage, string $answer)
    {
        $this->topic = $topic;
        $this->userMessage = $userMessage;
        $this->answer = $answer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Answering: $this->topic",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Emails.answer-email',
            with: [
                'topic' => $this->topic,
                'userMessage' => $this->userMessage,
                'answer' => $this->answer,
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
