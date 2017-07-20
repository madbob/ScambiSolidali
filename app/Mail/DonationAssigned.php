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
    private $institute;

    public function __construct($donation, $institute)
    {
        $this->donation = $donation;
        $this->institute = $institute;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione assegnata', env('APP_NAME'));
        return $this->subject($subject)->view('mails.donationassigned')->with(['donation' => $this->donation, 'institute' => $this->institute]);
    }
}
