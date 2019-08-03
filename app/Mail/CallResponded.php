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
    private $user;
    private $message;

    public function __construct($donation, $call, $user, $message)
    {
        $this->donation = $donation;
        $this->call = $call;
        $this->user = $user;
        $this->message = $message;
    }

    public function build()
    {
        $subject = sprintf('%s: donazione per appello %s', env('APP_NAME'), $this->call->title);
        return $this->subject($subject)->view('mails.callresponded')->with([
            'donation' => $this->donation,
            'call' => $this->call,
            'user' => $this->user,
            'message' => $this->message
        ]);
    }
}
