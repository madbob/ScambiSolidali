<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpirationNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $donation;

    public function __construct($donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione in scadenza', env('APP_NAME'));

		if ($this->donation->type == 'service') {
			$template = 'mails.serviceexpiring';
		}
		else {
			$template = 'mails.donationexpiring';
		}

        return $this->subject($subject)->view($template)->with(['donation' => $this->donation]);
    }
}
