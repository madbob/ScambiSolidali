<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationTransport extends Mailable
{
    use Queueable, SerializesModels;

    private $donation;
    private $user;

    public function __construct($donation, $user)
    {
        $this->donation = $donation;
        $this->user = $user;
    }

    public function build()
    {
        $subject = sprintf('%s: trasporto richiesto per donazione', env('APP_NAME'));
        return $this->subject($subject)->view('mails.donationtransport')->with(['donation' => $this->donation, 'user' => $this->user]);
    }
}
