<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationRevoked extends Mailable
{
    use Queueable, SerializesModels;

    private $donation;

    public function __construct($donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione revocata', env('APP_NAME'));
        return $this->subject($subject)->view('mails.donationrevoked')->with(['donation' => $this->donation]);
    }
}
