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

    public function __construct($donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        return $this->view('mails.donationassigned')->with(['donation' => $this->donation]);
    }
}
