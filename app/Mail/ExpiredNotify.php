<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpiredNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $donation;

    public function __construct($donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione scaduta e recuperabile', env('APP_NAME'));
        return $this->subject($subject)->view('mails.donationexpired')->with(['donation' => $this->donation]);
    }
}
