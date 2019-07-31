<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationRequested extends Mailable
{
    use Queueable, SerializesModels;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione richiesta', env('APP_NAME'));
        return $this->subject($subject)->replyTo($this->message->sender->email)->view('mails.donationrequested')->with(['user_message' => $this->message]);
    }
}
