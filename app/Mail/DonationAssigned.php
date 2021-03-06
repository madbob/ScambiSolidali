<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationAssigned extends Mailable
{
    use Queueable, SerializesModels;

    private $donation;
    private $user;
    private $institute;
    private $message;

    public function __construct($donation, $user, $institute, $message)
    {
        $this->donation = $donation;
        $this->user = $user;
        $this->institute = $institute;
        $this->message = $message;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione assegnata', env('APP_NAME'));
        return $this->subject($subject)->replyTo($this->user->email)->view('mails.donationassigned')->with([
            'donation' => $this->donation,
            'user' => $this->user,
            'institute' => $this->institute,
            'user_message' => $this->message,
        ]);
    }
}
