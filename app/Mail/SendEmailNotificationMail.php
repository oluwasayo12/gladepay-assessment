<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $companyName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Company Notification')
                    ->to('oluwasayo12@gmail.com')
                    ->view('emails.emailNotification');
    }
}
