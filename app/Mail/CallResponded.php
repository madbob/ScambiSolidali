<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CallResponded extends Mailable
{
    use Queueable, SerializesModels;

    private $donation;
    private $call;

    public function __construct($donation, $call)
    {
        $this->donation = $donation;
        $this->call = $call;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione per appello %s', env('APP_NAME'), $call->title);
        return $this->subject($subject)->view('mails.callresponded')->with(['donation' => $this->donation, 'call' => $call]);
    }
}
