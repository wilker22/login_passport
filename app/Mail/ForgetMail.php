<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($token)
    {
        $this->data = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password reset Link',
        );
    }

    // public function build()
    // {
    //     $data = $this->data;

    //     return $this->from('suport@wtech.com')->view('mail.forget', compact('data'))->subject('Password reset Link!');

    // }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $data  = $this->data;
       // dd($data);
        return new Content(
            view: 'mail.forget',
            with: [
                'data' => $data
            ],
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
