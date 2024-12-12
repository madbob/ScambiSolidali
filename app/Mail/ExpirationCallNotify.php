<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpirationCallNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $call;

    public function __construct($call)
    {
        $this->call = $call;
    }

    public function build()
    {
        $subject = sprintf('%s: appello in scadenza', env('APP_NAME'));
        return $this->subject($subject)->view('mails.callexpiring')->with(['call' => $this->call]);
    }
}
