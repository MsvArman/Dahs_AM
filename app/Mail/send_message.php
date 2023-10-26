<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class send_message extends Mailable
{
    use Queueable, SerializesModels;
    public array $content;
    /**
     * Create a new message instance.
     */
    public function __construct(array $content)
    {
        //
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Message',
        );
    }

    /**
     * Get the message content definition.
     */


     public function build()
    {
        return $this->subject($this->content['subject'])
            ->view('send_message');
    }


    public function content(): Content
    {
        return new Content(
            view: 'send_message',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
