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
    private $receiver;
    private $user;

    public function __construct($donation, $receiver, $user)
    {
        $this->donation = $donation;
        $this->receiver = $receiver;
        $this->user = $user;
    }

    public function build()
    {
        $subject = sprintf('%s: trasporto richiesto per donazione - %s', env('APP_NAME'), $this->donation->title);

        return $this->subject($subject)->view('mails.donationtransport')->with([
            'donation' => $this->donation,
            'receiver' => $this->receiver,
            'user' => $this->user
        ]);
    }
}
